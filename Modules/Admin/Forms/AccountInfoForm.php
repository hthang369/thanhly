<?php

namespace Modules\Admin\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;
use Laka\Core\Permissions\Role;

class AccountInfoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('username', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ])
            ->add('name', Field::TEXT, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9']]
            ])
            ->add('email', Field::EMAIL, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9']]
            ])
            ->add('roles', Field::CHECKBOX_GROUP, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'label' => 'Roles',
                'value' => function($form, $value) {
                    return $value->pluck('level')->toArray();
                },
                'choices' => Role::pluck('name', 'level')->toArray()
            ])
            ->add('btn-save', Field::BUTTON_BUTTON, [
                'attr' => ['class' => 'btn btn-primary', 'id' => 'btn-account', 'data-loading' => trans('admin::common.loading')],
                'label' => trans('admin::common.btn_save')
            ]);
    }
}
