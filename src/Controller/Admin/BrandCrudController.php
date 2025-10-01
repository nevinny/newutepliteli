<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Entity\Main;
use App\Entity\SectionType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BrandCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return Brand::class;
    }
}
