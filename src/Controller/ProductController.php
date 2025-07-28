<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class ProductController
{
    #[Route(
        path: '/catalog/{path}/p-{product}',
        name: 'category_index',
        requirements: [
            'path' => '.+',
            'product' => '.+',
            ],
        defaults: ['slug' => ''],
        priority: 30)]
    public function index(string $slug = '')
    {
        dd($slug);
    }
}
