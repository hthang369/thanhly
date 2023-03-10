<?php

namespace Modules\Admin\Forms\Products;

use Laka\Core\Forms\Field;
use Modules\Admin\Enums\CategoryType;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Forms\CoreForm;

class ProductsForm extends CoreForm
{
    protected $groupLangKey = 'products';

    public function buildForm()
    {
        $this->add('sku', Field::TEXT)
            ->add('name', Field::TEXT)
            ->add('price', Field::NUMBER)
            ->add('category_id[]', Field::MULTI_SELECT, [
                'choices' => resolve(CategoriesModel::class)->getDataByType(CategoryType::PRODUCT),
                'selected' => data_get($this->getModel(), 'category_id'),
            ])
            ->add('quantity', Field::NUMBER)
            ->add('excerpt', Field::TEXT)
            ->add('content', Field::TEXTAREA);
    }
}
