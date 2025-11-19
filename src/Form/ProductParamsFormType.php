<?php

namespace App\Form;

use App\Controller\Admin\FormField\ComboBoxField;
use App\Entity\ProductParams;
use App\Enum\Statuses;
use App\Form\Type\ComboBoxType;
use App\Service\Product\ParameterKeyMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductParamsFormType extends AbstractType
{
    public function __construct(
        private ParameterKeyMapper $parameterKeyMapper
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $parameterOptions = $this->parameterKeyMapper->getDatalistOptions();

//        dd($parameterOptions);
        $builder
            ->add('externalId', ChoiceType::class, [
                'label' => 'External ID',
                'required' => false,
                'attr' => [
                    'class' => 'js-external-id',
                ],
                'choices' => $parameterOptions,
            ])
//            ->add('title', TextType::class, [
//                'label' => 'Название',
//                'required' => false,
//            ])
            ->add('title', ChoiceType::class, [
                'label' => 'Название параметра',
                'required' => false,
                'choices' => $this->parameterKeyMapper->getDatalistOptions(true),
//                'datalist_options' => $parameterOptions,
//                'external_id_field' => 'externalId', // Просто имя поля, без префиксов
//                'placeholder' => 'Выберите параметр или введите свой вариант',
            ])
            ->add('val', TextType::class, [
                'label' => 'Значение',
                'required' => false,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'required' => true,
                'choices' => Statuses::choices(),
                'data' => Statuses::Active,
            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductParams::class,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'product_params';
    }
}
