<?php

namespace App\Controller\Admin;


use App\Entity\SearchList;

class SearchListCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return SearchList::class;
    }

}
