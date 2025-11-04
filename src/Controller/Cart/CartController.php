<?php

namespace App\Controller\Cart;

use App\Entity\ProductVariant;
use App\Repository\ProductVariantRepository;
use App\Service\Cart\CartService;
use App\Service\Cart\CartStorageResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cart', name: 'cart_', priority: 10000)]
class CartController extends AbstractController
{
    public function __construct(
        private readonly CartService $cartService,
        private Security $security,
    )
    {}

    #[Route(name: 'index', methods: ['GET'])]
    public function index(
        Request $request,
        ProductVariantRepository $variantRepository,
//        CartService $cartService,
//        CartStorageResolver $resolver,
    )
    {
        $user = $this->security->getUser();
//        dd('CartController', $user,$this->cartService->getStorage());
//        dd('CartController', $user, $resolver->resolve());
//        dd($this->cartService);
//        Request $request
        $items = $this->cartService->getItems();

        $cartItems = $variantRepository->findBy(['id' => array_keys($items)]);
//        $cartItems = $this->cartService->getItems();

//        dd($items, $cartItems);
        $template = 'personal/cart.html.twig';
        return $this->render($template, [
            'items' => $items,
            'cartItems' => $cartItems,
        ]);
    }

    #[Route('/checkout', name: 'checkout', priority: 10000)]
    public function checkout(Request $request)
    {
        $template = 'personal/checkout.html.twig';
        return $this->render($template, [
//            'items' => $items,
//            'cartItems' => $cartItems,
        ]);
    }

    #[Route('/add', name: 'add', priority: 10000)]
    public function add(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $content = json_decode($request->getContent(), true);

        $variantId = $content['variantId'];
        $quantity = max(1, $content['quantity']);
        $variant = $em->getRepository(ProductVariant::class)->find($variantId);

        if (!$variant) {
            return $this->json([
                'success' => false,
                'message' => 'Вариант товара не найден.',
            ], 404);
        }
        try {
            $this->cartService->add($variantId, $quantity);
            $data = [
                'success' => true,
                'message' => sprintf('Добавлен товар: %s', $variant->getProduct()->getTitle()),
                'data' => [
                    'id' => $variantId,
                    'quantity' => $quantity,
                ],
                'content' => $content,
            ];
            return $this->json($data);
        } catch (\Throwable $e) {
            $data = [
                'success' => false,
                'message' => sprintf('Ошибка добавления товара: %s', $e->getMessage()),
                'data' => [
                    'id' => $variantId,
                    'quantity' => $quantity,
                ],
                'content' => $content,
            ];
            return $this->json($data);
//            return $this->json(['error' => 'Failed to add to cart: ' . $e->getMessage()], 500);
        }

    }

    #[Route('/update', name: 'update', methods: ['POST'])]
    public function update(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $variantId = (int)($data['id'] ?? 0);
        $quantity = max(1, (int)($data['quantity'] ?? 1));

        if (!$variantId) {
            return $this->json(['success' => false, 'message' => 'ID товара не указан.'], 400);
        }

        try {
            $this->cartService->update($variantId, $quantity);
            return $this->json([
                'success' => true,
                'message' => 'Количество обновлено.',
                'cartCount' => $this->cartService->getCount(),
                'totalPrice' => $this->cartService->getTotal(),
                'totalCount' => $this->cartService->getPositionCount(),
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'message' => 'Ошибка обновления количества: ' . $e->getMessage(),
            ], 500);
        }
    }

    #[Route('/remove', name: 'remove', methods: ['POST'])]
    public function remove(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $variantId = (int)($data['id'] ?? 0);

        if (!$variantId) {
            return $this->json(['success' => false, 'message' => 'ID товара не указан.'], 400);
        }

        try {
            $this->cartService->removeVariant($variantId);
            return $this->json([
                'success' => true,
                'message' => 'Товар удалён из корзины.',
                'cartCount' => $this->cartService->getCount(),
                'totalPrice' => $this->cartService->getTotal(),
                'totalCount' => $this->cartService->getCount(),
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'message' => 'Ошибка удаления: ' . $e->getMessage(),
            ], 500);
        }
    }
}
