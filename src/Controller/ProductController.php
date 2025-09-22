<?php

namespace App\Controller;

use App\Enum\Statuses;
use App\Repository\ProductRepository;
use App\Repository\ProductVariantRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private ProductRepository $repository,
        private ProductVariantRepository $variantRepository,
        private EntityManagerInterface   $em,
    ) {}

    #[Route(
        path: '/catalog/{path}/p-{product}',
        name: 'product_index',
        requirements: [
            'path' => '.+',
            'product' => '.+',
            ],
//        defaults: ['slug' => ''],
//        priority: 100001
    )]
    public function index(Request $request)
    {
        $main = $request->attributes->get('main');
        $template = $request->attributes->get('template');
        $product = $this->repository->findOneBy(['id' => $main->getEntityId()]);
        if ($product->getImage() && str_contains($product->getImage(), '/')) {
            $imagePath = $product->getImage();
            $fileName = basename($imagePath);
            $product->setImage($fileName);
        }
        $queryId = $request->query->get('id');
//        dd($main,$product);
        if ($queryId !== null) {
            $variant = $this->variantRepository->findOneBy(['id' => $queryId]);
            $variant->setStatus(Statuses::Disabled);
            $this->em->persist($variant);
            $this->em->flush();
            return $this->redirect($main->getFullPath());
//            dd($product);
        }
//        $context['list'] = $this->listRepository->findBy(['parent' => $main->getEntityId()]);
        $specs = $this->parseTextToArray($product->getSpecs());
//        dd($product);
//        $this->parseTextToArray($specs)
        return $this->render($template, [
            'main' => $main,
            'product' => $product,
            'specs' => $specs,
//            'list' => $context['list'],
//            'form' => $form->createView()
        ]);
    }

    private function parseTextToArray($text)
    {
        // Разбиваем текст по переносам строк
        $lines = explode("\n", $text);
        $result = [];

        $currentKey = null;

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line)) {
                continue; // Пропускаем пустые строки
            }

            if ($currentKey === null) {
                // Это ключ (название характеристики)
                $currentKey = $line;
            } else {
                // Это значение
                $result[] = [
                    'property' => $currentKey,
                    'value' => $line
                ];
                $currentKey = null;
            }
        }

        return $result;
    }
}
