<?php

namespace Modules\Admin\Forms\Categories;

use Laka\Core\Forms\Field;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Forms\CoreForm;

class CategoriesForm extends CoreForm
{
    protected $groupLangKey = 'category';

    public function buildForm()
    {
        $this
            ->add('category_type', Field::HIDDEN, [
                'value' => $this->getFormOption('type') ?? $this->model->category_type
            ])
            ->add('category_name', Field::TEXT)
            ->add('category_excerpt', Field::TEXT)
            ->add('category_link', Field::TEXT)
            ->add('parent_id', Field::SELECT, [
                'choices' => resolve(CategoriesModel::class)->getDataByType(request()->segment(4)),
                'selected' => data_get($this->getModel(), 'parent_id'),
                'empty_value' => '=== Select category ==='
            ]);
    }
}
