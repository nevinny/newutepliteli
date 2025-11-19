<?php

namespace App\Form;

use App\Entity\ProductVariant;
use App\Enum\Availability;
use App\Enum\Statuses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductVariantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $rnd = $this->generateSecureUUID();
        $builder
            ->add('externalId', TextType::class, [
                'label' => 'External ID',
                'required' => true,
//                'data' => sprintf('%s-%s', 'INT', $rnd),
            ])
            ->add('sku', TextType::class, [
                'label' => 'Артикул',
                'required' => false,
            ])
            ->add('price', NumberType::class, [
                'label' => 'Цена',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'required' => true,
                'choices' => Statuses::choices(),
                'data' => Statuses::Active,
            ])
            ->add('availability', ChoiceType::class, [
                'label' => 'Доступность',
                'required' => false,
                'choices' => Availability::choices(),
                'data' => Availability::PreOrder,
            ])
            ->add('params', CollectionType::class, [
                'entry_type' => ProductParamsFormType::class,
                'label' => 'Параметры',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductVariant::class,
        ]);
    }

    private function generateSecureUUID()
    {
        $bytes = random_bytes(16);

        // Устанавливаем версию (4) и вариант (10xx)
        $bytes[6] = chr((ord($bytes[6]) & 0x0F) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3F) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }

}
