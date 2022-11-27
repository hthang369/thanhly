<?php

namespace Modules\Admin\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class SlidesForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('advertise_name', Field::TEXT)
            ->add('advertise_link', Field::TEXT)
            ->add('advertise_image', Field::FILE);
    }
}
