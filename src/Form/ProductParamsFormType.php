<?php

namespace App\Form;

use App\Entity\ProductParams;
use App\Enum\Statuses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductParamsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('externalId', TextType::class, [
                'label' => 'External ID',
                'required' => false,
            ])
            ->add('title', TextType::class, [
                'label' => 'Название',
                'required' => false,
            ])
            ->add('val', TextType::class, [
                'label' => 'Значение',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'required' => false,
                'choices' => Statuses::choices(),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductParams::class,
        ]);
    }
}
