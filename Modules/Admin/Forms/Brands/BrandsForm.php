<?php

namespace Modules\Admin\Forms\Brands;

use Laka\Core\Forms\Field;
use Modules\Core\Forms\CoreForm;

class BrandsForm extends CoreForm
{
    public function buildForm()
    {
        $this
            ->add('brand_name', Field::TEXT)
            ->add('brand_link', Field::TEXT)
            ->add('brand_image', Field::FILE);
    }
}
