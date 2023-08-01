<?php

namespace Modules\Admin\Forms\Masters;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class UomsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('uom_name', Field::TEXT)
            ->add('uom_factor', Field::NUMBER);
    }
}
