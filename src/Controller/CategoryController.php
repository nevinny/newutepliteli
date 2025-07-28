<?php

namespace App\Controller;

use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        private SectionRepository $repository
    ) {}
    #[Route(path: '/catalog/{slug}', name: 'category_index', requirements: ['slug' => '.+'], defaults: ['slug' => ''])]
    public function index(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['page'] = $this->repository->findOneBy(['id' => $main->getEntityId()]);
//        dd($context,$slug);
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
//            'form' => $form->createView()
        ]);
    }

}
