<?php

namespace App\Service;

use App\Entity\Contacts;
use App\Repository\ContactsRepository;

class ContactService
{
    public function __construct(private ContactsRepository $repo)
    {
    }

    public function get(): Contacts
    {
        return $this->repo->findOneBy([]) ?? new Contacts(); // singleton запись
    }
}
