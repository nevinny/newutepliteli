<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Main;
use App\Enum\Statuses;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::updateEntity($entityManager, $entityInstance);

        $repo = $entityManager->getRepository(Main::class);
        $main = $repo->findOneBy([
            'entityType' => 8,
            'entityId' => $entityInstance->getId()
        ]);
        // Обновляем статус в связанной сущности
        if ($main) {
            $main->setStatus($entityInstance->getStatus());
//            dd(($entityInstance->getStatus() == Statuses::Active),$entityInstance->getStatus(),$main);
            $entityManager->persist($main);
            $entityManager->flush();
        }
    }
}
