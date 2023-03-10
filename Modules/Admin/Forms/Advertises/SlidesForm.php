<?php

namespace Modules\Admin\Forms\Advertises;

use Laka\Core\Forms\Field;
use Modules\Core\Forms\CoreForm;

class SlidesForm extends CoreForm
{
    public function buildForm()
    {
        $this
            ->add('advertise_name', Field::TEXT)
            ->add('advertise_link', Field::TEXT)
            ->add('advertise_image', Field::FILE);
    }
}
