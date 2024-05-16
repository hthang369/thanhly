<?php

namespace Modules\Setting\Forms\Settings;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class SettingsMapForm extends Form
{
    public function buildForm()
    {
        if ($this->getData('action') == 'edit') {
            $this->add('web_map', Field::TEXTAREA, [
                'label' => trans('setting::configs.web_map'),
            ]);
        } else {
            $this->add('web_map', Field::MAP, [
                'tag' => 'div',
                'label' => trans('setting::configs.web_map'),
            ]);
            $this->add('edit', Field::BUTTON_LINK, [
                'label' => trans('admin::common.edit'),
                'variant' => 'primary',
                'attr' => ['href' => route(...$this->getFormOption('route')), 'class' => ['show_modal_form' => true]]
            ]);
        }
    }
}
