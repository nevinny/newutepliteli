<?php

namespace App\Controller\Admin;

use App\Entity\Section;
use App\Enum\Statuses;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\RequestStack;

class SectionCrudController extends DefaultCrudController
{
    private ?int $parentId = null;
    private $requestStack;

    public function __construct(
        RequestStack $requestStack,
        EntityManagerInterface $entityManager,
        private AdminUrlGenerator $adminUrlGenerator,)
    {
        $this->requestStack = $requestStack;
        // Вызываем конструктор родителя с теми же аргументами
        parent::__construct($requestStack, $entityManager);
    }

    public static function getEntityFqcn(): string
    {
        return Section::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // важно, чтобы getRequest в configureFields имел контекст запроса
            ->setFormOptions([
                'attr' => ['data-parent-id' => $this->parentId],
            ]);
    }



    public function configureFields(string $pageName): iterable
    {
        /** #################### SYSTEM #################### */
        yield FormField::addTab('System');



        $request = $this->requestStack->getCurrentRequest();
        $parentId = $request?->query->get('parent_id');

        if ($pageName === Crud::PAGE_NEW && $parentId) {
            // можно скрыть поле, если не хотите позволять менять родителя
            $parentField = AssociationField::new('parent', 'Родитель')
                ->setFormTypeOption('choice_label', function (Section $page) {
                    return str_repeat('— ', $page->getLevel()) . $page->getTitle();
                })
                ->setFormTypeOption('required', false)
            ;
//             $parentField->setFormTypeOption('visible', 'hidden')
            ;

            // Добавим listener, чтобы подставить parent по умолчанию
            $parentField->setFormTypeOption('empty_data', null);
        } else {
            $parentField = AssociationField::new('parent', 'Родитель')
                ->setFormTypeOption('choice_label', function (Section $page) {
                    return str_repeat('— ', $page->getLevel()) . $page->getTitle();
                })
                ->setFormTypeOption('required', false);
        }

        yield $parentField;


//        yield AssociationField::new('parent', 'Родитель')->hideOnIndex()
//            ->setFormTypeOption('choice_label', function (Section $page) {
//                return str_repeat('— ', $page->getLevel()) . $page->getTitle();
//            })
//            ->setFormTypeOption('required', false);
        yield ChoiceField::new('status')->setChoices([
            Statuses::Active,
            Statuses::Disabled,
        ]);
        yield AssociationField::new('type')
            ->setRequired(true)
            ->setFormTypeOption('choice_label', 'name')
            ->hideOnIndex()
        ;

        yield TextField::new('template', 'Template')->setMaxLength(255);

        /** #################### MAIN #################### */
        yield FormField::addTab('Main');
        yield IdField::new('id', 'ID')->onlyOnIndex();


        yield SlugField::new('slug', 'Slug')->setTargetFieldName('title');
        yield TextField::new('title', 'Title')->setMaxLength(255);
        yield TextEditorField::new('description', 'description')
            ->setNumOfRows(9)
            ->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h1'],
                    'heading2' => ['tagName' => 'h2'],
                    'heading3' => ['tagName' => 'h3'],
                ]
            ])
        ;

        /** #################### META #################### */
        yield FormField::addTab('Meta');
        yield TextField::new('metaTitle', 'Meta Title')->setMaxLength(255);
        yield TextField::new('metaKeywords', 'Meta Keywords')->setMaxLength(255);
        yield TextField::new('metaDescription', 'Meta Description')
        ->setMaxLength(255);
    }

    public function configureActions(Actions $actions): Actions
    {
        $request = $this->requestStack->getCurrentRequest();
        $parentId = $request ? $request->query->getInt('parent_id', 0) : 0;

        $url = $this->adminUrlGenerator
            ->setController(self::class)
            ->setAction('new')
            ->set('parent_id', $parentId)
            ->generateUrl();

        $customNewAction = Action::new('customNew', 'Add Section')
            ->linkToUrl($url)
            ->setCssClass('btn btn-primary')
            ->createAsGlobalAction()
        ;

        return $actions
            ->remove(Crud::PAGE_INDEX,Action::NEW)
            ->add(Crud::PAGE_INDEX,$customNewAction)
        ;
    }

    public function createEntity(string $entityFqcn)
    {
        $section = new Section();

        // Получаем текущий запрос
        $request = $this->requestStack->getCurrentRequest();
        $parentId = $request ? $request->query->getInt('parent_id') : null;

        if ($parentId) {
            $parent = $this->entityManager->getRepository(Section::class)->find($parentId);
            if ($parent) {
                $section->setParent($parent);
            }
        }

        return $section;
    }
}
