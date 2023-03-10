<?php

namespace Modules\Admin\Forms\Roles;

use Laka\Core\Forms\Field;
use Modules\Core\Forms\CoreForm;

class RolesForm extends CoreForm
{
    protected $groupLangKey = 'roles';

    public function buildForm()
    {
        $this
            ->add('level', Field::TEXT)
            ->add('name', Field::TEXT)
            ->add('role_rank', Field::TEXT);
    }
}
