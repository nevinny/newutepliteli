<?php

namespace App\Controller;

use App\Entity\News;
use App\Enum\Statuses;
use App\Repository\NewsRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{

    public function __construct(
        private NewsRepository $newsRepository,
//        private SectionRepository $pageRepository,
    )
    {}

    public function index($context): Response
    {
//        dd($page, $context, 'news index');
        $context['newsList'] = $this->newsRepository->findBy(
                [
                    'status' => Statuses::Active,
//                    'publishedAt' => null
                ], [
                    'datetime' => 'DESC'
                ],10, 0);
//        dd($context);
        return $this->render($context['template'], $context);
    }


}
