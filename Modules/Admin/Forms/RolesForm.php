<?php

namespace Modules\Admin\Forms;

use Spatie\Permission\Models\Role;
use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class RolesForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('level', Field::TEXT)
            ->add('name', Field::TEXT)
            ->add('role_rank', Field::TEXT);
    }
}
