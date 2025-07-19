<?php

namespace App\Repository;

use App\Entity\Section;
use App\Enum\Statuses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Section>
 */
class SectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Section::class);
    }

    public function findMenuPages(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.status = :status')
            ->andWhere('p.parent is null')
            ->orderBy('p.id', 'ASC')
            ->setParameter('status', Statuses::Active)
            ->getQuery()
            ->getResult();
    }

    public function findOneByFullPath(string $path): ?Section
    {
        return $this->findOneBy(['fullPath' => $path]);
    }
}
