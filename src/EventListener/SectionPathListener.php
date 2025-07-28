<?php

namespace App\EventListener;

use App\Entity\Main;
use App\Entity\Section;
use App\Service\SectionPathGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

final class SectionPathListener
{
    public function __construct(
        private EntityManagerInterface $em,
        private SectionPathGenerator $pathGenerator,
        private LoggerInterface $logger,
    ) {}

    public function prePersist(Section $section, PrePersistEventArgs $event): void
    {
        $this->updateFullPath($section);
    }

    public function preUpdate(Section $section, PreUpdateEventArgs $event): void
    {
        $this->updateFullPath($section);
    }
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->logger->debug('postPersist triggered for '.get_class($entity), [
            'id' => $entity->getId(),
            'data' => method_exists($entity, 'toArray') ? $entity->toArray() : []
        ]);
        $this->handleEntity($entity);
    }

    private function handleEntity(object $entity): void
    {
//        if (!$this->isSupported($entity)) {
//            return;
//        }

        $main = $this->em->getRepository(Main::class)->findOneBy([
            'entityId' => $entity->getId(),
            'entityType' => $this->getEntityType($entity)
        ]) ?? new Main();

        $main
            ->setFullPath($this->pathGenerator->generateFullPath($entity))
            ->setEntityType($this->getEntityType($entity))
            ->setEntityId($entity->getId())
//            ->setTemplate($this->templateResolver->resolve($entity))
        ;

        $this->em->persist($main);
        $this->em->flush();
    }
    private function getEntityType(object $entity): string
    {
        return method_exists($entity, 'getEntityType')
            ? $entity->getEntityType()
            : strtolower((new \ReflectionClass($entity))->getShortName());
    }

    private function updateFullPath(Section $section): void
    {
        $section->setFullPath($this->pathGenerator->generateFullPath($section));
    }
}
