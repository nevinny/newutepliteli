<?php

namespace App\Controller;

use App\Entity\Main;
use App\Entity\News;
use App\Enum\Statuses;
use App\Repository\MainRepository;
use App\Repository\NewsRepository;
use App\Repository\ProductRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    public function __construct(
        private MainRepository $mainRepository,
    )
    {}
    #[Route(path: '/', name: 'index', priority: 10000)]
    public function index(
        ProductRepository $productRepository,
    ): Response
    {
        $list = $productRepository->findBy([
            'isfp' => true,
            'status' => Statuses::Active,
            ]);
//        dd($list);
        return $this->render('index.html.twig', [
            'controller_name' => 'IndexController',
            'list' => $list,
        ]);
    }
    #[Route(path: '/{slug}', name: 'page_show', requirements: ['slug' => '(?!admin/).+'], defaults: ['slug' => ''])]
    public function show(Request $request, string $slug = ''): Response
    {
        // Убираем завершающий / если есть
        $slug = '/' . trim($slug, '/');

        $main = $this->mainRepository->findOneByFullPath($slug);
//        dd($main);
        if (!$main || !$main->isPublished()) {
            throw $this->createNotFoundException('Страница не найдена');
        }

        $template = $main->getTemplate() ?? $main->getEntityType()->getTemplate();
        if(!str_contains($template, '.html.twig')) {
            $template .= '.html.twig';
        }
        $context = [
            'main' => $main,
            'entityId' => $main->getEntityId(),
            'template' => $template
        ];
        $controller = $main->getEntityType()->getControllerClass();
//        dd($template, $main, $controller);
        if (!$controller) {
            throw new \RuntimeException('No controller defined for page type: ' . $main->getEntityType()->getCode());
        }

//        return $this->forward($controller, ['context' => $context]);
        // Создаем новый Request с добавленными атрибутами
        $newRequest = $request->duplicate(null, null, [
            'main' => $main,
            'entityId' => $main->getEntityId(),
            'template' => $template,
            '_controller' => $main->getEntityType()->getControllerClass()
        ]);

        // Пробрасываем все GET-параметры как есть
        return $this->forward($newRequest->attributes->get('_controller'), [
            'request' => $newRequest
        ]);
    }
}
