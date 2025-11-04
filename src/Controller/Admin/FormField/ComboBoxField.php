<?php

namespace App\Controller\Admin\FormField;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use App\Form\Type\ComboBoxType;

class ComboBoxField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setFormType(ComboBoxType::class)
            ->setTemplatePath('admin/fields/combo_box.html.twig');
    }

    public function setDatalistOptions(array $options): self
    {
        $this->setFormTypeOption('datalist_options', $options);
        return $this;
    }

    public function setExternalIdField(string $fieldName): self
    {
        $this->setFormTypeOption('external_id_field', $fieldName);
        return $this;
    }

    public function setPlaceholder(string $placeholder): self
    {
        $this->setFormTypeOption('placeholder', $placeholder);
        return $this;
    }
}
