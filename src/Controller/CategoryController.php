<?php

namespace App\Controller;

use App\Entity\Category;
use App\Enum\Statuses;
use App\Repository\CategoryRepository;
use App\Repository\ProductParamsRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductVariantRepository;
use App\Repository\SectionRepository;
use App\Service\ProductListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryRepository $repository,
        private ProductRepository $listRepository,
        private ProductVariantRepository $variantRepository,
        private ProductParamsRepository  $paramsRepository,
        private ProductListService       $productListService,
    ) {}
    #[Route(path: '/catalog/{slug}', name: 'category_index', requirements: ['slug' => '.+'], defaults: ['slug' => ''], priority: -3)]
    public function index(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['page'] = $this->repository->findOneBy(['id' => $main->getEntityId()]);
//        dd($main, $template, $context);
        $context['list'] = $this->listRepository->findBy([
            'parent' => $context['page']->getId(),
            'status' => Statuses::Active,
        ], ['title' => 'ASC']);
        $productIds = [];
        $list = [];
        foreach ($context['list'] as $product) {
            $list[$product['p_id']] = $product;
//            $productIds[] = $product['p_id'];
        }

        $variants = $this->variantRepository->findBy(['product' => array_keys($list)]);
//        $variantsByProduct = [];
        $variantIds = [];
        foreach ($variants as $variant) {
            $prodictId = $variant->getProduct()->getId();
//            $list[$prodictId]['variants'][$variant->getId()] = $variant;
            $variantIds[] = $variant->getId();
        }

        $params = $this->paramsRepository->findBy(['variant' => $variantIds]);
        foreach ($params as $param) {
            $v = $param->getVariant();
            $p = $v->getProduct();
            $list[$p->getId()]['params'][$param->getId()] = $param;
//            dd($v,$pId->getId());
            $list[$p->getId()]['variants'][$v->getId()]['params'][$param->getId()] = $param;
//            dd($param);
        }
        $productList = $this->productListService->getProductsForCategory(
            $main->getEntityId()
        );
//        dd($productList->productsWithVariants);
//        dd($productIds,$variantsByProduct,$context['list'],$variants);

//        dd($productList->productsWithVariants);
//        dd($main,$context);
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
            'list' => $list,
            'newList' => $productList->productsWithVariants,
//            'form' => $form->createView()
        ]);
    }

}
