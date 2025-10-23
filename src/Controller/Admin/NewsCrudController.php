<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Enum\Statuses;
use App\Service\ImageUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;

class NewsCrudController extends DefaultCrudController
{
    public function __construct(
        private ImageUploaderService $imageUploader,
        private RequestStack $requestStack,
        EntityManagerInterface $entityManager,
        protected AdminUrlGenerator $adminUrlGenerator,

    ) {
        parent::__construct($requestStack, $entityManager, $adminUrlGenerator);
    }

    public static function getEntityFqcn(): string
    {
        return News::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('System');
        $request = $this->requestStack->getCurrentRequest();
        $parentId = $request?->query->get('parent_id', 0);

//        if ($pageName === Crud::PAGE_NEW && $parentId) {
            // можно скрыть поле, если не хотите позволять менять родителя
            $parentField = IdField::new('parent', 'Родитель');
            $parentField->setFormTypeOption('data', $parentId);
//        }

        yield $parentField;
        yield ChoiceField::new('status')->setChoices([
            Statuses::Active,
            Statuses::Disabled,
        ]);
//        yield AssociationField::new('type')
//            ->setRequired(true)
//            ->setFormTypeOption('choice_label', 'name');

        yield FormField::addTab('Main');
        yield IdField::new('id', 'ID')->onlyOnIndex();


        yield SlugField::new('slug', 'Slug')->setTargetFieldName('title');
        yield TextField::new('title', 'Title')->setMaxLength(255);
        yield DateTimeField::new('datetime', 'Date and time');
        yield TextEditorField::new('description', 'description')
            ->setNumOfRows(9);


        yield FormField::addTab('Images');
        // Поле для загрузки изображения (форма)
        yield Field::new('imageFile', 'Загрузить изображение')
            ->setFormType(FileType::class)
            ->onlyOnForms()
            ->setRequired(false);

        // Отображение текущего изображения (форма, только если есть image)
//        yield ImageField::new('image', 'Текущее изображение')
//            ->setBasePath('/uploads/news')
//            ->onlyOnDetail()
//            ->setLabel('Оригинал');

        // Превью — в index и detail
        yield ImageField::new('imagePreview', 'Превью')
            ->setBasePath('/uploads/news')
            ->onlyOnIndex()
            ->setLabel('Превью');

//        yield ImageField::new('imagePreview', 'Превью')
//            ->setBasePath('/uploads/news')
//            ->setUploadDir('/public/uploads/news')
//            ->onlyOnDetail()
//            ->setLabel('Превью');
        yield Field::new('image', 'Текущее изображение')
            ->onlyOnForms()
//            ->setFormTypeOption('mapped', false) // НЕ связан с сущностью
            ->setFormTypeOption('required', false)
            ->setFormTypeOption('disabled', true)
            ->setTemplatePath('admin/fields/image_preview.html.twig');


//        yield Field::new('imageFile', 'Изображение')
//            ->setFormType(FileType::class)
//            ->onlyOnForms()
//            ->setRequired(false);
//        yield ImageField::new('image')->setBasePath('/uploads/news')->onlyOnIndex();



        yield FormField::addTab('Meta');
        yield TextField::new('metaTitle', 'Meta Title')->setMaxLength(255);
        yield TextField::new('metaKeywords', 'Meta Keywords')->setMaxLength(255);
        yield TextField::new('metaDescription', 'Meta Description')
            ->setMaxLength(255);
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        $this->handleImageUpload($entityInstance);
        parent::persistEntity($em, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        $this->handleImageUpload($entityInstance);
        parent::updateEntity($em, $entityInstance);
    }

    private function handleImageUpload(News $news): void
    {
        $request = $this->getContext()->getRequest();
        /** @var UploadedFile|null $file */
        $file = $request->files->get('News')['imageFile'] ?? null;

        if ($file instanceof UploadedFile) {
            [$filename, $preview] = $this->imageUploader->uploadAndResize($file);
            $news->setImage($filename);
            $news->setImagePreview($preview);
        }
    }


}
