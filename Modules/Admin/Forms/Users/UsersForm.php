<?php

namespace Modules\Admin\Forms\Users;

use Spatie\Permission\Models\Role;
use Laka\Core\Forms\Field;
use Modules\Core\Forms\CoreForm;

class UsersForm extends CoreForm
{
    protected $groupLangKey = 'users';

    public function buildForm()
    {
        $this
            ->add('username', Field::TEXT)
            ->add('password', Field::PASSWORD)
            ->add('name', Field::TEXT)
            ->add('email', Field::EMAIL)
            ->add('roles[]', Field::CHECKBOX_GROUP, [
                'label' => 'Roles',
                'value' => function($form, $value) {
                    return $value->pluck('level')->toArray();
                },
                'choices' => Role::pluck('name', 'level')->toArray()
            ]);
    }
}
