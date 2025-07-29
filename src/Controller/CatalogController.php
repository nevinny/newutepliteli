<?php

namespace App\Controller;

use App\Enum\Statuses;
use App\Repository\CategoryRepository;
use App\Repository\ContactsRepository;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends AbstractController
{
    public function __construct(
        private CategoryRepository $repository,
    ) {}
    public function index(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['page'] = $this->repository->findOneBy(['id' => $main->getEntityId()]);
        $context['list'] = $this->repository->findBy([
            'parent' => $main->getId(),
            'status' => Statuses::Active,
        ]);
//        dd($main,$context);
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
            'list' => $context['list'],
//            'form' => $form->createView()
        ]);
    }
}
