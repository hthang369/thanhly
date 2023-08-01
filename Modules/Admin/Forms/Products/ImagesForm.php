<?php

namespace Modules\Admin\Forms\Products;

use Laka\Core\Forms\Field;
use Modules\Core\Entities\Masters\PromotionsModel;
use Modules\Core\Entities\Masters\VariantsModel;
use Modules\Core\Forms\CoreForm;

class ImagesForm extends CoreForm
{
    protected $groupLangKey = 'products';

    public function buildForm()
    {
        $this
            ->add('image', Field::FILE)
            ->add('image_list[]', Field::MULTI_FILE, [
                'label' => module_trans('products.image_list')
            ])
            ->add('promotions[]', Field::MULTI_SELECT, [
                'choices' => PromotionsModel::pluck('promotion_name', 'id'),
                'selected' => $this->getModel()->promotions,
            ])
            ->add('variant_id', Field::SELECT, [
                'choices' => VariantsModel::pluck('variant_name', 'id')->toArray(),
                'selected' => $this->getModel()->variant,
                'empty_value' => 'Select ...'
            ])
            ->add('ob_title', Field::TEXT)
            ->add('ob_desception', Field::TEXT)
            ->add('ob_keyword', Field::TEXT);
    }
}
