<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComboBoxType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $parent = $form->getParent();

        // Для коллекций: вычисляем правильное имя поля externalId
        if ($parent && $options['external_id_field']) {
            $externalIdFieldName = $this->resolveExternalIdFieldName($form, $options['external_id_field']);
            $view->vars['external_id_field'] = $externalIdFieldName;
        } else {
            $view->vars['external_id_field'] = $options['external_id_field'];
        }

        $view->vars['datalist_options'] = $options['datalist_options'];
        $view->vars['placeholder'] = $options['placeholder'];

        $view->vars['attr'] = array_merge($view->vars['attr'] ?? [], [
            'list' => $options['datalist_options'] ? 'combo-list-' . $view->vars['id'] : null,
            'autocomplete' => 'off',
            'data-combo-box' => 'true',
            'data-external-id-field' => $view->vars['external_id_field'],
            'placeholder' => $options['placeholder'],
        ]);
    }

    private function resolveExternalIdFieldName(FormInterface $form, string $externalIdField): string
    {
        $parent = $form->getParent();
        if (!$parent) {
            return $externalIdField;
        }

        // Получаем полный путь к полю в форме
        $propertyPath = $form->getPropertyPath();
        if ($propertyPath) {
            // Для коллекций: заменяем текущее свойство на externalId
            $pathParts = explode('.', (string)$propertyPath);
            array_pop($pathParts); // Убираем текущее поле (title)
            $pathParts[] = $externalIdField;
            return implode('.', $pathParts);
        }

        // Альтернативный способ: через имя родительской формы
        $parentName = $parent->getName();
        return $parentName ? $parentName . '[' . $externalIdField . ']' : $externalIdField;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'datalist_options' => [],
            'external_id_field' => null,
            'placeholder' => 'Выберите из списка или введите свой вариант',
            'compound' => false,
        ]);

        $resolver->setAllowedTypes('datalist_options', 'array');
        $resolver->setAllowedTypes('external_id_field', ['string', 'null']);
        $resolver->setAllowedTypes('placeholder', 'string');
    }

    public function getParent(): string
    {
        return TextType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'combo_box';
    }
}
