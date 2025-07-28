<?php

namespace App\EventListener;

use App\Entity\Main;
use App\Entity\SectionType;
use App\Interface\SystemEntityInterface;
use App\Service\SectionPathGenerator;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

#[AsDoctrineListener(event: Events::postPersist)]
#[AsDoctrineListener(event: Events::postFlush)]
final class UniversalEntityListener
{
    private array $queuedMains = [];

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SectionPathGenerator $pathGenerator,
        private readonly LoggerInterface $logger,
    ) {}

    public function postPersist(PostPersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($this->isSystemEntity($entity) || $entity instanceof Main) {
            return;
        }

        $main = $this->prepareMain($entity);
        if ($main !== null) {
            $this->queuedMains[] = $main;
        }
    }

    public function postFlush(PostFlushEventArgs $event): void
    {
        if (empty($this->queuedMains)) {
            return;
        }

        foreach ($this->queuedMains as $main) {
            if (!$this->em->contains($main)) {
                $this->em->persist($main);
            }
        }

        $this->queuedMains = [];
        $this->em->flush();
    }

    private function prepareMain(object $entity): ?Main
    {
        $entityType = $this->resolveEntityType($entity);

        $main = $this->findOrCreateMain($entity, $entityType);

        $parent = $this->resolveParent($entity, $main);
        $this->updateMainData($main, $entity, $entityType, $parent);
        $this->generateAndValidateFullPath($main);
        $this->setAdditionalFields($main, $entity);

        return $main;
    }

    private function resolveEntityType(object $entity): SectionType
    {
        $type = $this->getEntityType($entity);

        return $type instanceof SectionType
            ? $type
            : $this->em->getRepository(SectionType::class)->findOneBy(['code' => $type])
            ?? throw new \RuntimeException("SectionType '$type' not found");
    }

    private function findOrCreateMain(object $entity, SectionType $entityType): Main
    {
        return $this->em->getRepository(Main::class)->findOneBy([
            'entityId' => $entity->getId(),
            'entityType' => $entityType
        ]) ?? (new Main())->setEntityType($entityType)->setEntityId($entity->getId());
    }

    private function resolveParent(object $entity, Main $main): ?Main
    {
        if ($main->getParent() || !method_exists($entity, 'getParent')) {
            return $main->getParent();
        }

        $parentId = $entity->getParent();
        return $parentId ? $this->em->getRepository(Main::class)->find($parentId) : null;
    }

    private function updateMainData(Main $main, object $entity, SectionType $type, ?Main $parent): void
    {
        $main->setSlug($entity->getSlug())
            ->setTitle($entity->getTitle())
            ->setParent($parent)
            ->setStatus($entity->getStatus())
            ->setIsNode($type->isNode());

        if ($type->getTemplate() && !$main->getTemplate()) {
            $main->setTemplate($type->getTemplate());
        }
    }

    private function generateAndValidateFullPath(Main $main): void
    {
        $newPath = $this->pathGenerator->generateFullPath($main);
        $existing = $this->em->getRepository(Main::class)->findOneBy(['fullPath' => $newPath]);

        if ($existing && $existing->getId() !== $main->getId()) {
            $this->logger->warning('Full path already exists', [
                'path' => $newPath,
                'existingId' => $existing->getId(),
                'conflictWith' => $main->getId(),
            ]);

            throw new \RuntimeException(sprintf('Path "%s" already exists (ID %d)', $newPath, $existing->getId()));
        }

        $main->setFullPath($newPath);
    }

    private function setAdditionalFields(Main $main, object $entity): void
    {
        foreach (['Ord', 'Template', 'CreatedAt', 'UpdatedAt'] as $field) {
            $getter = 'get' . $field;
            $setter = 'set' . $field;

            if (method_exists($entity, $getter) && method_exists($main, $setter)) {
                $main->$setter($entity->$getter());
            }
        }
    }

    private function getEntityType(object $entity): string|SectionType
    {
        return method_exists($entity, 'getEntityType')
            ? $entity->getEntityType()
            : strtolower((new \ReflectionClass($entity))->getShortName());
    }

    private function isSystemEntity(object $entity): bool
    {
        return $entity instanceof SystemEntityInterface;
    }
}
