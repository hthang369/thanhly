<?php

namespace Modules\Admin\Forms\Products;

use Laka\Core\Forms\Field;
use Modules\Admin\Enums\CategoryType;
use Modules\Admin\Repositories\Brands\BrandsRepository;
use Modules\Admin\Repositories\Categories\CategoriesRepository;
use Modules\Core\Forms\CoreForm;

class ProductsForm extends CoreForm
{
    protected $groupLangKey = 'products';

    public function buildForm()
    {
        $this
            ->add('sku', Field::TEXT)
            ->add('name', Field::TEXT)
            ->add('price', Field::NUMBER)
            ->add('categories[]', Field::MULTI_SELECT, [
                'label' => module_trans("{$this->groupLangKey}.categories"),
                'choices' => resolve(CategoriesRepository::class)->getDataByType(CategoryType::PRODUCT),
                'selected' => data_get($this->getModel(), 'categories'),
            ])
            ->add('brand_id', Field::SELECT, [
                'choices' => resolve(BrandsRepository::class)->getSelectedList('brand_name', 'id', '=== Select brand ==='),
                'selected' => data_get($this->getModel(), 'brand_id'),
            ])
            ->add('quantity', Field::NUMBER)
            ->add('excerpt', Field::TEXT)
            ->add('content', Field::TEXTAREA);
    }
}
