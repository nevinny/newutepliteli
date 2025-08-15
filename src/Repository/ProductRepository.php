<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    const ENTITY_TYPE_ID = 18;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('App\Entity\Main', 'm', 'WITH', 'm.entityId = p.id AND m.entityType = :typeId')
            ->setParameter('typeId', self::ENTITY_TYPE_ID)
        ;
        $qb->addSelect('p AS product', 'm AS main');

        // критерии
        foreach ($criteria as $field => $value) {
            if (str_contains($field, '.')) {
                // пример: main.status => ['m.status' => 'active']
                [$alias, $col] = explode('.', $field, 2);
                if ($alias === 'main') {
                    $qb->andWhere("m.$col = :param_$col")
                        ->setParameter("param_$col", $value);
                } elseif ($alias === 'product') {
                    $qb->andWhere("p.$col = :param_$col")
                        ->setParameter("param_$col", $value);
                }
            } else {
                // без указания алиаса — считаем, что это поле product
                $qb->andWhere("p.$field = :param_$field")
                    ->setParameter("param_$field", $value);
            }
        }

        // сортировка
        if ($orderBy) {
            foreach ($orderBy as $field => $direction) {
                if (str_contains($field, '.')) {
                    [$alias, $col] = explode('.', $field, 2);
                    $qb->addOrderBy(($alias === 'main' ? "m.$col" : "p.$col"), $direction);
                } else {
                    $qb->addOrderBy("p.$field", $direction);
                }
            }
        }

        // лимит и оффсет
        if ($limit !== null) {
            $qb->setMaxResults($limit);
        }
        if ($offset !== null) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getScalarResult();
    }
}
