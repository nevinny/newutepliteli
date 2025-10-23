<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\ProductVariant;
use Doctrine\ORM\EntityManagerInterface;
use App\Enum\Statuses;

class VariantMoveService
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function moveVariant(ProductVariant $variant, Product $newProduct): void
    {
        $oldProduct = $variant->getProduct();

        if ($oldProduct === $newProduct) {
            return;
        }

        $variant->setProduct($newProduct);
        $this->em->persist($variant);
        $this->em->flush();

        // Проверим, остались ли варианты у старого продукта
        if ($oldProduct->getVariants()->count() === 0) {
            $oldProduct->setStatus(Statuses::Disabled);
            $this->em->persist($oldProduct);
            $this->em->flush();
        }
    }

    public function getAvailableTargetProducts(Product $currentProduct): array
    {
        return $this->em->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->andWhere('p.id != :currentId')
            ->andWhere('p.status != :disabledStatus')
            ->andWhere('p.parent = :parent')
            ->setParameter('currentId', $currentProduct->getId())
            ->setParameter('disabledStatus', Statuses::Disabled)
            ->setParameter('parent', $currentProduct->getParent())
            ->orderBy('p.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
