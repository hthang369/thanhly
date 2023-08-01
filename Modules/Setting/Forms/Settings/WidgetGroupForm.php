<?php

namespace Modules\Setting\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class WidgetGroupForm extends Form
{
    public function buildForm()
    {
        $this->add('name', Field::TEXT)
            ->add('devices', 'nav_tab', [
                'choices' => [
                    'xs' => [
                        'icon' => 'fa-mobile',
                        'text' => 'XS'
                    ],
                    'sm' => [
                        'icon' => 'fa-tablet',
                        'text' => 'SM'
                    ],
                    'lg' => [
                        'icon' => 'fa-laptop',
                        'text' => 'LG'
                    ]
                ]
            ])
            ->add('columns', 'content_tab', [
                'choices' => [
                    'xs' => 1,
                    'sm' => 1,
                    'lg' => 1
                ]
            ])
            ->add('key', Field::HIDDEN, [
                'value' => 'group'
            ])
            ->add('save_widget', Field::BUTTON_SUBMIT, [
                'label' => trans('setting::configs.save_info'),
                'attr' => ['class' => 'btn btn-success']
            ]);
    }
}
