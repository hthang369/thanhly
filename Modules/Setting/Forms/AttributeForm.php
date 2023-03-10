<?php

namespace Modules\Setting\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Laka\Core\Permissions\Role;
use Modules\Setting\Entities\AttributeModel;

class AttributeForm extends Form
{
    public function buildForm()
    {
        $this->add('key', Field::TEXT)
            ->add('language', Field::TEXT)
            ->add('parent_id', Field::SELECT, [
                'choices' => AttributeModel::whereNull('parent_id')->pluck('key', 'id')->toArray(),
                'selected' => data_get($this->getModel(), 'parent_id'),
                'empty_value' => '=== Select attribute ==='
            ]);
    }
}
