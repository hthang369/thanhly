<?php

namespace Modules\Admin\Forms\Contacts;

use Modules\Admin\Entities\CategoriesModel;
use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class ContactsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('subject', Field::STATIC)
            ->add('fullname', Field::STATIC)
            ->add('phone', Field::STATIC)
            ->add('content', Field::STATIC);
    }
}
