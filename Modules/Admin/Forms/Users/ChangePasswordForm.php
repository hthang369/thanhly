<?php

namespace Modules\Admin\Forms\Users;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class ChangePasswordForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('current_password', Field::PASSWORD, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-5']],
                'attr' => ['class' => ['col-7']]
            ])
            ->add('password', Field::PASSWORD, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-5']],
                'attr' => ['class' => ['col-7']]
            ])
            ->add('password_confirmation', Field::PASSWORD, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-5']],
                'attr' => ['class' => ['col-7']]
            ])
            ->add('btn-save', Field::BUTTON_BUTTON, [
                'attr' => ['class' => 'btn btn-primary', 'id' => 'btn-change', 'data-loading' => trans('admin::common.loading')],
                'label' => trans('admin::common.btn_save')
            ]);
    }
}
