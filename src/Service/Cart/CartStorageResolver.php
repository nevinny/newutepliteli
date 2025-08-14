<?php

namespace App\Service\Cart;

use App\Entity\User;
use App\Interface\CartStorageInterface;
use Symfony\Bundle\SecurityBundle\Security;

class CartStorageResolver
{
    public function __construct(
        private Security $security,
        private SessionCartStorage $sessionStorage,
        private DatabaseCartStorage $dbStorage,
    ) {}

    public function resolve(): CartStorageInterface
    {
        $user = $this->security->getUser();

        if ($user instanceof User) {
            return $this->dbStorage;
        }

        return $this->sessionStorage;
    }
}
