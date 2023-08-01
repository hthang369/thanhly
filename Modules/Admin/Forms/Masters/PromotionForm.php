<?php

namespace Modules\Admin\Forms\Masters;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Modules\Core\Enums\PromotionType;

class PromotionForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('promotion_name', Field::TEXT)
            ->add('promotion_value', Field::TEXT)
            ->add('promotion_type', Field::SELECT, [
                'choices' => PromotionType::listConstains()
            ]);
    }
}
