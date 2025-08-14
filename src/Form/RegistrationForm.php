<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Электронная почта',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'example@mail.com'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пожалуйста, введите email',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Я согласен с условиями использования',
                'mapped' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Для продолжения необходимо принять условия',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Пароли должны совпадать.',
                'options' => ['attr' => ['autocomplete' => 'new-password']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Пароль',
                    'constraints' => [
                        new NotBlank(['message' => 'Пароль не может быть пустым']),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Пароль должен быть не меньше {{ limit }} символов',
                            'max' => 50,
                        ]),
                    ],
                ],
                'second_options' => ['label' => 'Повторите пароль'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => ['class' => 'needs-validation', 'novalidate' => 'novalidate'],
        ]);
    }
}
