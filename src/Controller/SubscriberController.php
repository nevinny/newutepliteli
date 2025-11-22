<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Enum\Statuses;
use App\Form\SubscribeType;
use App\Repository\SubscriberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/subscription', name: 'subscription_', priority: 10001)]
class SubscriberController extends AbstractController
{
    public function renderSubscriptionForm(): Response
    {
        $form = $this->createForm(SubscribeType::class, null, [
            'attr' => ['class' => 'subscription-form']
        ]);

        return $this->render('_block/subscription.html.twig', [
            'subscriptionForm' => $form->createView(),
        ]);
    }

    #[Route('/subscribe', name: 'subscribe', methods: ['POST'])]
    public function subscribe(
        Request                $request,
        SubscriberRepository   $subscriberRepository,
        EntityManagerInterface $entityManager
    ): Response
    {

        $token = $request->request->get('token');
        $redirectUrl = $request->request->get('redirect_url', '/');
        if (!$this->isCsrfTokenValid('subscribe', $token)) {
            $this->addFlash('error', 'Неверный токен безопасности');
            return $this->redirect($redirectUrl);// или откуда пришел запрос
        }

        $email = $request->request->get('email');
        // Валидация email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addFlash('error', 'Некорректный email адрес');
            return $this->redirect($redirectUrl);
        }

        // Проверка на существование
        $existingSubscriber = $subscriberRepository->findOneBy(['email' => $email]);
        if ($existingSubscriber && $existingSubscriber->getStatus() == Statuses::Active) {
            $this->addFlash('warning', 'Вы уже подписаны на рассылку');
            return $this->redirect($redirectUrl);
        }

        $user = $this->getUser();

//        dd($user,$existingSubscriber);
        if ($existingSubscriber) {
            // Реактивация подписки
            $existingSubscriber->setStatus(Statuses::Active);
            if ($user) {
                $existingSubscriber->setUser($user);
            }
            $subscriber = $existingSubscriber;
        } else {
            // Создание подписчика
            $subscriber = new Subscriber();
            $subscriber->setEmail($email);
            $subscriber->setCreatedAt(new \DateTime());
            if ($user) {
                $subscriber->setUser($user);
            }
            $entityManager->persist($subscriber);
        }


        $entityManager->flush();

        $this->addFlash('success', 'Спасибо за подписку!');
        return $this->redirect($redirectUrl);

    }

    #[Route('/unsubscribe/{token}', name: 'unsubscribe', methods: ['GET', 'POST'])]
    public function unsubscribe(
        string                 $token,
        SubscriberRepository   $subscriberRepository,
        EntityManagerInterface $entityManager
    )
    {
        $subscriber = $subscriberRepository->findOneBy([
            'token' => $token,
            'status' => Statuses::Active
        ]);

        // Показываем информационную страницу вместо ошибки
        return $this->render('subscribe/unsubscribe_not_found.html.twig', [
            'token' => $token
        ]);

        // Отключаем подписку
        $subscriber->setStatus(Statuses::Disabled);
        $entityManager->flush();

        // Показываем страницу подтверждения
        return $this->render('subscribe/unsubscribe.html.twig', [
            'email' => $subscriber->getEmail(),
            'token' => $token // передаем токен для возможности подписаться снова
        ]);
    }

    #[Route('/resubscribe/{token}', name: 'resubscribe')]
    public function resubscribe(
        string                 $token,
        SubscriberRepository   $subscriberRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $subscriber = $subscriberRepository->findOneBy([
            'token' => $token,
            'status' => Statuses::Disabled
        ]);

        if (!$subscriber) {
            throw $this->createNotFoundException('Подписка не найдена или уже активна');
        }

        $subscriber->setStatus(Statuses::Active);
        $entityManager->flush();

        $this->addFlash('success', 'Вы снова подписаны на рассылку!');

        return $this->redirectToRoute('index');
    }
}
