<?php

namespace Modules\Setting\Forms\Attributes;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Laka\Core\Permissions\Role;
use Modules\Setting\Entities\Attributes\AttributesModel;
use Modules\Setting\Repositories\Attributes\AttributesRepository;

class AttributesForm extends Form
{
    public function buildForm()
    {
        $this->add('key', Field::TEXT)
            ->add('language', Field::TEXT)
            ->add('value', Field::TEXT)
            ->add('type', Field::SELECT, [
                'choices' => Field::listConstains(),
                'selected' => data_get($this->getModel(), 'type'),
                'empty_value' => '=== Select type ==='
            ])
            ->add('parent_id', Field::SELECT, [
                'choices' => resolve(AttributesRepository::class)->getSelectedNestedList(),
                'selected' => data_get($this->getModel(), 'parent_id'),
                'empty_value' => '=== Select attribute ==='
            ]);
    }
}
