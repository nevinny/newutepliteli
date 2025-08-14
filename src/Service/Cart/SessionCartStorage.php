<?php

namespace App\Service\Cart;

use App\Interface\CartStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionCartStorage implements CartStorageInterface
{
    private SessionInterface $session;

    public function __construct(RequestStack $requestStack)
    {
        $session = $requestStack->getSession();

        if (!$session) {
            throw new \RuntimeException('Session is not available.');
        }

        $this->session = $session;
    }

    public function getItems(): array
    {
        return $this->session->get('cart', []);
    }

    public function addItem(int $variantId, int $quantity): void
    {
        $cart = $this->getItems();
        $cart[$variantId] = ($cart[$variantId] ?? 0) + $quantity;
        $this->session->set('cart', $cart);
    }

    public function removeItem(int $variantId): void
    {
        $cart = $this->getItems();
        unset($cart[$variantId]);
        $this->session->set('cart', $cart);
    }

    public function clear(): void
    {
        $this->session->remove('cart');
    }

    public function hasItem(int $variantId): bool
    {
        return array_key_exists($variantId, $this->getItems());
    }

}
