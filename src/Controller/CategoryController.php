<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class CategoryController
{
    #[Route(path: '/catalog/{slug}', name: 'category_index', requirements: ['slug' => '.+'], defaults: ['slug' => ''])]
    public function index(string $slug = '')
    {
        dd($slug);
    }

}
