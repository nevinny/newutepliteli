<?php

namespace App\Form;

use App\Entity\ProductVariant;
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
        $builder
            ->add('externalId', TextType::class, [
                'label' => 'External ID',
                'required' => false,
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
                'required' => false,
                'choices' => Statuses::choices(),
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
}
