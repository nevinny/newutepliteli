<?php

namespace App\Controller;

use App\Enum\Statuses;
use App\Repository\BrandListRepository;
use App\Repository\BrandRepository;
use App\Repository\ContactsRepository;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BrandController extends AbstractController
{
    public function __construct(
        private BrandListRepository $repository,
        private BrandRepository $itemRepository,
    ) {}

    public function index(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['page'] = $this->repository->findOneBy(['id' => $main->getEntityId()]);
        $context['list'] = $this->itemRepository->findBy([
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
    public function show(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $context['page'] = $this->itemRepository->findOneBy(['id' => $main->getEntityId()]);
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
