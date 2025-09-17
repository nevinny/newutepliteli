<?php

namespace App\Repository;

use App\Entity\PriceType;
use App\Entity\ProductPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductPrice>
 */
class ProductPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductPrice::class);
    }

    public function upsert(ProductPrice $price): int
    {
        $connection = $this->getEntityManager()->getConnection();

        $sql = "
            INSERT INTO product_price (variant_id, type_id, price, currency, coefficient, created_at, updated_at)
            VALUES (:variant_id, :type, :price, :currency, :coefficient, NOW(), NOW())
            ON DUPLICATE KEY UPDATE
                price = VALUES(price),
                updated_at = NOW()
        ";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue('variant_id', $price->getVariant()->getId());
        $stmt->bindValue('type', $price->getType()->getId());
        $stmt->bindValue('price', $price->getPrice());
        $stmt->bindValue('currency', $price->getCurrency());
        $stmt->bindValue('coefficient', $price->getCoefficient());

        return $stmt->executeStatement();
    }
}
