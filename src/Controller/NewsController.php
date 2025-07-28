<?php

namespace App\Controller;

use App\Entity\News;
use App\Enum\Statuses;
use App\Repository\NewsRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{

    public function __construct(
        private NewsRepository $repository,
    )
    {}

    public function index(Request $request): Response
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['list'] = $this->repository->findBy(
                [
                    'status' => Statuses::Active,
//                    'publishedAt' => null
                ], [
                    'datetime' => 'DESC'
                ],10, 0);
//        dd($context);
        $context['main'] = $main;
        return $this->render($template, $context);
    }

    public function show(Request $request): Response
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
