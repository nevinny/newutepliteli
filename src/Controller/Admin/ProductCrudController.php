<?php

namespace App\Controller\Admin;

use App\Entity\Main;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


//    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
//    {
//        parent::updateEntity($entityManager, $entityInstance);
//
//        $repo = $entityManager->getRepository(Main::class);
//        $main = $repo->findOneBy([
//            'entityType' => 18,
//            'entityId' => $entityInstance->getId()
//        ]);
//        // Обновляем статус в связанной сущности
//        if ($main) {
//            $main->setStatus($entityInstance->getStatus());
//            $main->setTitle($entityInstance->getTitle());
//            $main->setSlug($entityInstance->getSlug());
//            $entityManager->persist($main);
//            $entityManager->flush();
//        }
//    }
}
