<?php

namespace App\Repository;

use App\Entity\ProductVariant;
use App\Enum\Statuses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductVariant>
 */
class ProductVariantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductVariant::class);
    }

    /**
     * Находит варианты товаров без параметров
     *
     * @return ProductVariant[]
     */
    public function findVariantsWithoutParams(): array
    {
        return $this->createQueryBuilder('pv')
            ->leftJoin('pv.params', 'pp')
            ->where('pp.variant IS NULL')
            ->getQuery()
            ->getResult();
    }

    /**
     * Удаляет варианты товаров без параметров
     *
     * @return int Количество удаленных записей
     */
    public function removeVariantsWithoutParams(): int
    {
        $variantsToRemove = $this->findVariantsWithoutParams();

        if (empty($variantsToRemove)) {
            return 0;
        }

        $entityManager = $this->getEntityManager();
        $count = 0;

        foreach ($variantsToRemove as $variant) {
            $variant->setStatus(Statuses::Deleted);
            $entityManager->persist($variant);
            $count++;
        }

        $entityManager->flush();

        return $count;
    }
}
