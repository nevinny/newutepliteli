<?php

namespace App\Controller;

use App\Enum\Statuses;
use App\Repository\CategoryRepository;
use App\Repository\ContactsRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CatalogController extends AbstractController
{
    public function __construct(
        private CategoryRepository $repository,
        private ProductRepository $listRepository
    ) {}

    #[Route(name: 'catalog')]
    public function index(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['page'] = $this->repository->findOneBy(['id' => $main->getEntityId()]);
        $context['list'] = $this->listRepository->findBy([
//            'parent' => $main->getId(),
            'status' => Statuses::Active,
        ]);
//        dd($context['list']);
        $categoryCounter = [];
        foreach ($context['list'] as $category) {
            if(!array_key_exists($category['p_parent'], $categoryCounter)) {
                $categoryCounter[$category['p_parent']] = 0;
            }
            $categoryCounter[$category['p_parent']]++;
        }
//        dd($main,$categoryCounter,$context);
        return $this->render($template, [
            'main' => $main,
            'categoryCounter' => $categoryCounter,
            'page' => $context['page'],
            'list' => $context['list'],
//            'form' => $form->createView()
        ]);
    }
}
