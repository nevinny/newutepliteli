<?php

namespace App\Controller\Admin;

use App\Service\Import\ProductImportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ImportController extends AbstractController
{

    #[Route('/admin/import/products', name: 'admin_product_import', priority: 500)]
    public function import(ProductImportService $importService): Response
    {
        $token = $_GET['token'] ?? null;

        // простой токен, для продакшена лучше JWT/API Token и доступ по роли
        if ($token !== $_ENV['IMPORT_SECRET_TOKEN']) {
            return new Response('Unauthorized', 401);
        }

        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/webdata/import0_1.xml';

        $imported = $importService->importFromFile($filePath);

        return new Response("Импортировано товаров: $imported");
    }
}
