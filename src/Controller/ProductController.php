<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private ProductRepository $repository,
    ) {}

    #[Route(
        path: '/catalog/{path}/p-{product}',
        name: 'product_index',
        requirements: [
            'path' => '.+',
            'product' => '.+',
            ],
//        defaults: ['slug' => ''],
//        priority: 100001
    )]
    public function index(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $product = $this->repository->findOneBy(['id' => $main->getEntityId()]);
        if ($product->getImage() && str_contains($product->getImage(), '/')) {
            $imagePath = $product->getImage();
            $fileName = basename($imagePath);
            $product->setImage($fileName);
        }

//        $context['list'] = $this->listRepository->findBy(['parent' => $main->getEntityId()]);
//        dd($main,$product);
        return $this->render($template, [
            'main' => $main,
            'product' => $product,
//            'list' => $context['list'],
//            'form' => $form->createView()
        ]);
    }
}
