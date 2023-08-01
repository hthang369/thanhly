<?php

namespace Modules\Admin\Forms\Categories;

use Laka\Core\Forms\Field;
use Modules\Admin\Enums\CategoryType;
use Modules\Admin\Repositories\Categories\CategoriesRepository;
use Modules\Core\Entities\Brands\BrandsModel;
use Modules\Core\Forms\CoreForm;

class CategoriesForm extends CoreForm
{
    protected $groupLangKey = 'categories';

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
                'choices' => resolve(CategoriesRepository::class)->getDataByType(request('category_type')),
                'selected' => data_get($this->getModel(), 'parent_id'),
                'empty_value' => '=== Select category ==='
            ]);
        if (str_is(request('category_type'), CategoryType::PRODUCT)) {
            $this->add('brands[]', Field::MULTI_SELECT, [
                'label' => module_trans("{$this->groupLangKey}.brands"),
                'choices' => BrandsModel::pluck('brand_name', 'id'),
                'selected' => data_get($this->getModel(), 'brands'),
            ]);
        }
    }
}
