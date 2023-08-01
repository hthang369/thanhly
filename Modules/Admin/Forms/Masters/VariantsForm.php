<?php

namespace Modules\Admin\Forms\Masters;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class VariantsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('variant_name', Field::TEXT)
            ->add('variant_color', Field::COLOR);
    }
}
