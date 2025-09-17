<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    public function __construct(
        private ProductRepository $repository,
    )
    {
    }

    #[Route(path: '/search/{slug}', name: 'search_index', requirements: ['slug' => '.+'], defaults: ['slug' => ''], priority: -3)]
    public function index(Request $request)
    {
        $query = $request->query->get('q', '');
        $page = $request->query->getInt('page', 1);

        $results = [];
        $totalResults = 0;

        if (!empty($query)) {
            // Поиск продуктов по названию, описанию и другим полям
            $results = $this->repository->searchProducts($query, $page, 12);
            $totalResults = $this->repository->countSearchResults($query);
        }
//        dd($results);
        return $this->render('search/index.html.twig', [
            'query' => $query,
            'results' => $results,
            'totalResults' => $totalResults,
            'currentPage' => $page,
            'totalPages' => ceil($totalResults / 12)
        ]);
    }
}
