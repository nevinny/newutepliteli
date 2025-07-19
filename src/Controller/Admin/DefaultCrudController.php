<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Symfony\Component\HttpFoundation\RequestStack;

class DefaultCrudController extends AbstractCrudController
{
    public function __construct(
        private RequestStack             $requestStack,
        protected EntityManagerInterface $entityManager,
    )
    {}

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined(true)
            ;
    }


    public static function getEntityFqcn(): string
    {
        return '';
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $request = $this->requestStack->getCurrentRequest();
        $parentId = $request?->query->get('parent_id');

        $entityClass = $entityDto->getFqcn();
        $metadata = $this->entityManager->getClassMetadata($entityClass);

        if ($metadata->hasAssociation('parent')) {
            if ($parentId !== null) {
                $qb->andWhere('entity.parent = :parentId')
                    ->setParameter('parentId', $parentId);
            } else {
                $qb->andWhere('entity.parent IS NULL');
            }
        }
        return $qb;
    }
}
