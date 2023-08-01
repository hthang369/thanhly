<?php

namespace Modules\Admin\Forms\Brands;

use Laka\Core\Forms\Field;
use Modules\Admin\Enums\CategoryType;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Forms\CoreForm;

class BrandsForm extends CoreForm
{
    protected $groupLangKey = 'brands';

    public function buildForm()
    {
        $this
            ->add('brand_name', Field::TEXT)
            ->add('brand_link', Field::TEXT)
            ->add('brand_image', Field::FILE)
            ->add('categories[]', Field::MULTI_SELECT, [
                'label' => module_trans("{$this->groupLangKey}.categories"),
                'choices' => resolve(CategoriesModel::class)->getDataByType(CategoryType::PRODUCT),
                'selected' => data_get($this->getModel(), 'categories'),
            ]);
    }
}
