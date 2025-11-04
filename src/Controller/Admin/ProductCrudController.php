<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Main;
use App\Entity\Product;
use App\Entity\ProductVariant;
use App\Entity\SectionType;
use App\Enum\Statuses;
use App\Form\ProductVariantFormType;
use App\Service\MainSyncService;
use App\Service\SectionPathGenerator;
use App\Service\VariantMoveService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class ProductCrudController extends DefaultCrudController
{
    private VariantMoveService $moveService;
    private EntityManagerInterface $em;
    private $request;
    private $requestStack;

    public function __construct(
        RequestStack             $requestStack,
        EntityManagerInterface   $em,
        public AdminUrlGenerator $adminUrlGenerator,
        VariantMoveService           $moveService,
        protected MainSyncService    $mainSyncService,
        private SectionPathGenerator $pathGenerator,
    )
    {
        parent::__construct($requestStack, $em, $adminUrlGenerator, $pathGenerator);
        $this->moveService = $moveService;
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    protected function getSystemFields(): iterable
    {
        $request = $this->requestStack->getCurrentRequest();
        $parentId = $request?->query->get('parent_id', 0);

        $parentField = IdField::new('parent', 'Родитель')->hideOnIndex();

        $category = $this->entityManager->getRepository(Category::class)->find($parentId);

        $parentField->setFormTypeOption('data', $category->getId());


        yield $parentField;
        yield ChoiceField::new('status', 'Статус')
            ->setChoices(Statuses::cases())
            ->setFormTypeOption('choice_label', 'name')
            ->setFormTypeOption('choice_value', 'value');
        yield IdField::new('ord', 'Порядок')->hideOnIndex();
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::persistEntity($entityManager, $entityInstance);
        $this->mainSyncService->syncProduct($entityInstance);
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

    public function configureActions(Actions $actions): Actions
    {
        $actions = parent::configureActions($actions);

        // Добавляем действие переноса варианта
        $moveVariantAction = Action::new('moveVariant', 'Перенести вариант', 'fa fa-random')
            ->linkToCrudAction('showMoveVariantForm')
            ->addCssClass('btn btn-warning')
            ->displayIf(fn(Product $product) => !$product->getVariants()->isEmpty());

        return $actions
            ->add(Crud::PAGE_EDIT, $moveVariantAction)
            ->add(Crud::PAGE_DETAIL, $moveVariantAction)
            ->add(Crud::PAGE_INDEX, Action::new('moveVariant', 'Перенести вариант')
                ->linkToCrudAction('showMoveVariantForm')
//                ->addCssClass('btn btn-warning')
            );
    }

    public function showMoveVariantForm(Request $request): Response
    {
        $productId = $request->query->get('entityId');

        if (!$productId) {
            $this->addFlash('danger', 'Product ID not provided');
            return $this->redirectToRoute('admin');
        }

        $product = $this->entityManager->getRepository(Product::class)->find($productId);

        if (!$product) {
            $this->addFlash('danger', 'Продукт не найден');
            return $this->redirectToRoute('admin');
        }

        $variants = $product->getVariants();
        $availableProducts = $this->moveService->getAvailableTargetProducts($product);

        return $this->render('admin/product/move_variant_form.html.twig', [
            'product' => $product,
            'variants' => $variants,
            'availableProducts' => $availableProducts,
        ]);
    }

    /**
     * Обработка переноса варианта
     */
    public function processVariantMove(Request $request): RedirectResponse
    {
        $productId = $request->request->get('product_id');
        $variantId = $request->request->get('variant_id');
        $targetProductId = $request->request->get('target_product_id');

        if (!$productId || !$variantId || !$targetProductId) {
            $this->addFlash('error', 'Необходимо заполнить все поля');
            return $this->redirectToIndex();
        }

        $variant = $this->entityManager->getRepository(ProductVariant::class)->find($variantId);
        $targetProduct = $this->entityManager->getRepository(Product::class)->find($targetProductId);

        if (!$variant || !$targetProduct) {
            $this->addFlash('error', 'Вариант или целевой продукт не найдены');
            return $this->redirectToIndex();
        }

        try {
            $this->moveService->moveVariant($variant, $targetProduct);

            $this->addFlash('success', sprintf(
                'Вариант "%s" успешно перенесен в продукт "%s"',
                $variant->getSku() ?: $variant->getExternalId(),
                $targetProduct->getTitle()
            ));
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Ошибка при переносе варианта: ' . $e->getMessage());
        }

        return $this->redirectToIndex();
    }

    /**
     * Перенаправление на индексную страницу
     */
    private function redirectToIndex(): RedirectResponse
    {
        $url = $this->adminUrlGenerator
            ->setController(self::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        return $this->redirect($url);
    }

    /**
     * Перенаправление на страницу редактирования продукта
     */
    private function redirectToEdit(Product $product): RedirectResponse
    {
        $url = $this->adminUrlGenerator
            ->setController(self::class)
            ->setAction(Action::EDIT)
            ->setEntityId($product->getId())
            ->generateUrl();

        return $this->redirect($url);
    }
//
//    public function moveVariant(AdminContext $context): Response
//    {
//        $variant = $context->getEntity()->getInstance();
//        $productRepository = $this->container->get('doctrine')->getRepository(Product::class);
//
//        // Получаем список продуктов для выбора (кроме текущего)
//        $availableProducts = $productRepository->findActiveProductsExcept($variant->getProduct());
//
//        if ($this->request->isMethod('POST')) {
//            $targetProductId = $this->request->request->get('target_product');
//            $targetProduct = $productRepository->find($targetProductId);
//
//            if ($targetProduct) {
//                $this->moveService->moveVariant($variant, $targetProduct);
//
//                $this->addFlash('success', 'Вариант успешно перенесен');
//
//                $url = $this->adminUrlGenerator
//                    ->setController(ProductCrudController::class)
//                    ->setAction(Action::INDEX)
//                    ->generateUrl();
//
//                return $this->redirect($url);
//            }
//
//            $this->addFlash('error', 'Продукт не найден');
//        }
//
//        return $this->render('admin/product_variant/move.html.twig', [
//            'variant' => $variant,
//            'products' => $availableProducts,
//            'pageTitle' => 'Перенос варианта продукта',
//        ]);
//    }
//
//
//    public function moveVariantAction(AdminContext $context, Request $request): RedirectResponse
//    {
//        /** @var Product $product */
//        $product = $context->getEntity()->getInstance();
//        $formData = $request->get('dialogForm', []);
//
//        $variantId = $formData['variant'] ?? null;
//        $newProductId = $formData['newProduct'] ?? null;
//
//        if (!$variantId || !$newProductId) {
//            $this->addFlash('danger', 'Не выбраны все поля.');
//            return $this->redirect($context->getReferrer());
//        }
//
//        $variant = $this->em->getRepository(ProductVariant::class)->find($variantId);
//        $newProduct = $this->em->getRepository(Product::class)->find($newProductId);
//
//        if (!$variant || !$newProduct) {
//            $this->addFlash('danger', 'Неверные данные.');
//            return $this->redirect($context->getReferrer());
//        }
//
//        $this->moveService->moveVariant($variant, $newProduct);
//
//        $this->addFlash(
//            'success',
//            sprintf('Вариант "%s" успешно перенесён в продукт "%s".', $variant->getTitle(), $newProduct->getTitle())
//        );
//
//        return $this->redirect($context->getReferrer());
//    }
}
