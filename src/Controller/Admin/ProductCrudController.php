<?php

namespace App\Controller\Admin;

use App\Entity\Main;
use App\Entity\Product;
use App\Enum\CoolingType;
use App\Enum\Statuses;
use App\Form\ProductVariantFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\RequestStack;

class ProductCrudController extends DefaultCrudController
{

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    /**
     * @throws \ReflectionException
     */
    public function configureFields(string $pageName): iterable
    {
        // System tab
        yield FormField::addTab('System');
        foreach ($this->getSystemFields() as $field) {
            yield $field;
        }

        // Main tab
        yield FormField::addTab('Main');
        foreach ($this->getMainFields($pageName) as $field) {
            yield $field;
        }

        // Variants & Parameters tab - ТОЛЬКО ДЛЯ ПРОДУКТОВ
        yield FormField::addTab('Variants & Parameters');
        yield FormField::addPanel('Варианты товара');
        yield CollectionField::new('variants', 'Варианты товара')
            ->setEntryType(ProductVariantFormType::class)
            ->allowAdd()
            ->allowDelete()
            ->renderExpanded()
            ->setFormTypeOption('by_reference', false)
            ->hideOnIndex()
            ->setColumns(12);

        // Images tab
        if ($this->hasImageFields()) {
            yield FormField::addTab('Images');
            foreach ($this->getImageFields() as $field) {
                yield $field;
            }
        }

        // Meta tab
        yield FormField::addTab('Meta');
        foreach ($this->getMetaFields() as $field) {
            yield $field;
        }
    }
}
