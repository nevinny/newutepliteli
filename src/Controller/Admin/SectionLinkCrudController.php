<?php

namespace App\Controller\Admin;

use App\Entity\SectionLink;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SectionLinkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SectionLink::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('parentType')
                ->setLabel('Раздел (Main)'),
            AssociationField::new('childType')
                ->setLabel('Тип секции'),
        ];
    }
}
