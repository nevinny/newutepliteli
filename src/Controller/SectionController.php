<?php

namespace App\Controller;

use App\Enum\Statuses;
use App\Repository\MainRepository;
use App\Repository\NewsRepository;
//use App\Repository\PageRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class SectionController extends AbstractController
{
    public function __construct(
        private SectionRepository $repository
    ) {}

    #[Route(name: 'text')]
    public function index(Request $request): Response
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['page'] = $this->repository->findOneBy(['id' => $main->getEntityId()]);
//        dd($context);
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
//            'form' => $form->createView()
        ]);
    }
}
