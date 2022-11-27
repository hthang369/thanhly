<?php

namespace Modules\Admin\Forms;

use Modules\Admin\Entities\CategoriesModel;
use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class CategoriesForm extends Form
{
    public function buildForm()
    {
        // dd($this);
        $this
            ->add('category_type', Field::HIDDEN, [
                'value' => $this->getFormOption('type') ?? $this->model->category_type
            ])
            ->add('category_name', Field::TEXT)
            ->add('category_excerpt', Field::TEXT)
            ->add('category_link', Field::TEXT)
            ->add('parent_id', Field::SELECT, [
                'choices' => CategoriesModel::whereNull('parent_id')->pluck('category_name', 'id')->toArray(),
                'selected' => data_get($this->getModel(), 'parent_id'),
                'empty_value' => '=== Select category ==='
            ]);
    }
}
