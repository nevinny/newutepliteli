<?php

namespace App\Controller;

use App\Entity\Category;
use App\Enum\Statuses;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryRepository $repository,
        private ProductRepository $listRepository,
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
//        dd($context['list']);
//        dd($main,$context);
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
            'list' => $context['list'],
//            'form' => $form->createView()
        ]);
    }

}
