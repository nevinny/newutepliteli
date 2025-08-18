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
//        name: 'product_index',
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
        $context['page'] = $this->repository->findOneBy(['id' => $main->getEntityId()]);
//        $context['list'] = $this->listRepository->findBy(['parent' => $main->getEntityId()]);
//        dd($main,$context['page']);
        return $this->render($template, [
            'main' => $main,
            'product' => $context['page'],
//            'list' => $context['list'],
//            'form' => $form->createView()
        ]);
    }
}
