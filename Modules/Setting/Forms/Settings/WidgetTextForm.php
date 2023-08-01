<?php

namespace Modules\Setting\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class WidgetTextForm extends Form
{
    public function buildForm()
    {
        $this->add('name', Field::TEXT)
            ->add('type', Field::HIDDEN, [
                'value' => 'text'
            ])
            ->add('save_widget', Field::BUTTON_SUBMIT, [
                'label' => trans('setting::configs.save_info'),
                'attr' => ['class' => 'btn btn-success']
            ]);
    }
}
