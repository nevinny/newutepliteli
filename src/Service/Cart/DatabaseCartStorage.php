<?php

namespace App\Service\Cart;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\User;
use App\Interface\CartStorageInterface;
use App\Repository\ProductRepository;
use App\Repository\ProductVariantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class DatabaseCartStorage implements CartStorageInterface
{
//    private ?UserInterface $user;
    private $cart;
    public function __construct(
        private EntityManagerInterface $em,
        private Security $security,
        private ProductVariantRepository $variantRepo,
//        private Cart $cart,
    ) {
        $this->user = $this->getUser();
        $this->cart = $this->user->getCurrentCart();
    }

    public function getItems(): array
    {
        $items = [];
        foreach ($this->cart->getItems() as $item) {
            $items[$item->getVariant()->getId()] = $item->getQuantity();
        }
        return $items;
    }

    public function addItem(int $variantId, int $quantity): void
    {
        $variant = $this->variantRepo->find($variantId);

        if (!$variant) {
            throw new \InvalidArgumentException('Variant not found');
        }

        $existingItem = $this->cart->getItemByVariant($variant);

//        dd($variantId, $quantity, $existingItem);
        if ($existingItem) {
            $existingItem->setQuantity($existingItem->getQuantity() + $quantity);
        } else {
            $newItem = new CartItem();
            $newItem->setVariant($variant);
            $newItem->setQuantity($quantity);
//            $newItem->setCart($this->cart);
//            dd($newItem);
            $this->cart->addItem($newItem);

            $this->em->persist($newItem);
        }

        $this->em->flush();
    }


    public function updateItem(int $variantId, int $quantity): void
    {
        $variant = $this->variantRepo->find($variantId);

        if (!$variant) {
            throw new \InvalidArgumentException('Variant not found');
        }

        $existingItem = $this->cart->getItemByVariant($variant);

        if ($existingItem) {
            $existingItem->setQuantity($quantity);
        } else {
            $newItem = new CartItem();
            $newItem->setVariant($variant);
            $newItem->setQuantity($quantity);
            $this->cart->addItem($newItem);

            $this->em->persist($newItem);
        }

        $this->em->flush();
    }

    public function removeItem(int $variantId): void
    {
        $variant = $this->variantRepo->find($variantId);
        $item = $this->cart->getItemByVariant($variant);
        if ($item) {
            $this->em->remove($item);
            $this->em->flush();
        }
    }

    public function clear(): void
    {
        foreach ($this->cart->getItems() as $item) {
            $this->em->remove($item);
        }
        $this->em->flush();
    }

    public function hasItem(int $variantId): bool
    {
        return $this->cart->hasItems($variantId);
    }

    private function getUser(): User
    {
        $user = $this->security->getUser();
        if (!$user instanceof User) {
//            throw new \LogicException('No authenticated user');
            return  new User();
        }
        return $user;
    }

}
