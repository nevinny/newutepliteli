<?php

namespace App\Controller;

use App\Enum\Statuses;
use App\Repository\NewsRepository;
use App\Repository\PageRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SectionController extends AbstractController
{
    public function __construct(
        private SectionRepository $pageRepository,
        private NewsRepository $newsRepository,
    )
    {}

    public function index($context): Response
    {
        return $this->render($context['template'], $context);
    }

    #[Route(path: '/{slug}', name: 'page_show', requirements: ['slug' => '.+'], defaults: ['slug' => ''])]
    public function show(string $slug = ''): Response
    {
        // Убираем завершающий / если есть
        $slug = '/' . trim($slug, '/');

        $page = $this->pageRepository->findOneByFullPath($slug);
        $pages = $this->pageRepository->findMenuPages();
//        if (!$page || !$page->isPublished()) {
//            throw $this->createNotFoundException('Страница не найдена');
//        }

//        dd($page);
        $template = $page->getTemplate() ?? $page->getType()->getTemplate();
        if(!str_contains($template, '.html.twig')) {
            $template .= '.html.twig';
        }
        $context = [
            'pages' => $pages,
            'page' => $page,
            'template' => $template
        ];
        $controller = $page->getType()->getControllerClass();

        // Fallback для типа 'text' (если controller = NULL)
        if ($page->getType()->getCode() === 'text' && empty($controller)) {
            $controller = 'App\Controller\SectionController::index';
        }

        if (!$controller) {
            throw new \RuntimeException('No controller defined for page type: ' . $page->getType()->getCode());
        }

        return $this->forward($controller, ['context' => $context]);

//        return match ($page->getType()->getCode())
//        {
//            'news_list' => $this->forward($page->getType()->getControllerClass(), [
//                'context' => $context
//            ]),
//            'text' => $this->forward('App\Controller\SectionController::index', [
//                'context' => $context
//            ]),
//        };
    }
}
