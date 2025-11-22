<?php

namespace App\Controller\Personal;

use App\Entity\Subscriber;
use App\Entity\User;
use App\Enum\Statuses;
use App\Form\ChangePasswordForm;
use App\Form\ProfileType;
use App\Form\SubscribeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/personal', name: 'personal_', priority: 500)]
#[IsGranted('ROLE_USER')]
class AccountController extends AbstractController
{
    #[Route(name: 'account')]
    public function index(Request $request)
    {
        $template = 'personal/index.html.twig';
        $context = ['page' => ['title' => 'Account', 'description' => '']];
        $main = [];
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
//            'form' => $form->createView()
        ]);
    }

    #[Route(path: '/orders', name: 'orders')]
    public function orders(Request $request)
    {
        $template = 'personal/orders.html.twig';
        $context = ['page' => ['title' => 'Orders', 'description' => '']];
        $main = [];
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
//            'form' => $form->createView()
        ]);
    }

    #[Route(path: '/cart', name: 'cart')]
    public function cart(Request $request)
    {
        $template = 'personal/cart.html.twig';
        $context = ['page' => ['title' => 'Orders', 'description' => '']];
        $main = [];
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
//            'form' => $form->createView()
        ]);
    }

    #[Route(path: '/private', name: 'private')]
    public function private(Request $request, EntityManagerInterface $em)
    {
        $template = 'personal/private.html.twig';
        $context = ['page' => ['title' => 'Личные данные', 'description' => '']];
        $main = [];
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Профиль обновлен.');
            return $this->redirectToRoute('personal_private');
        }
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
            'form' => $form->createView()
        ]);
    }

    #[Route(path: '/change-password', name: 'password')]
    public function changePassword(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $em)
    {
        $template = 'personal/change-password.html.twig';
        $context = ['page' => ['title' => 'Изменение пароля', 'description' => '']];
        $main = [];
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Пароль обновлен.');
            return $this->redirectToRoute('personal_password');
        }
        return $this->render($template, [
            'main' => $main,
            'page' => $context['page'],
            'form' => $form->createView()
        ]);
    }

    #[Route(path: '/subscribe', name: 'subscribe')]
    public function subscribe(Request $request, EntityManagerInterface $em)
    {
        $template = 'personal/subscription.html.twig';
        $context = ['page' => ['title' => 'Подписка', 'description' => '']];
        $main = [];
        /** @var User $user */
        $user = $this->getUser();
        $subscription = $em->getRepository(Subscriber::class)->findOneBy(['email' => $user->getEmail()]);
        if ($subscription && $subscription->getStatus() == Statuses::Active) {
            $user->setIsSubscribed(true);
        }

        $form = $this->createForm(SubscribeType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', ' обновлен.');
        }
        return $this->render($template, [
            'user' => $user,
            'subscription' => $subscription,
            'main' => $main,
            'page' => $context['page'],
            'form' => $form->createView()
        ]);
    }
}
