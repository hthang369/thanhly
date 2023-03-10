<?php

namespace Modules\Setting\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class SettingsForm extends Form
{
    public function buildForm()
    {
        if ($this->getData('action') == 'edit') {
            $this->add('web_name', Field::TEXT, [
                'label' => trans('setting::configs.web_name'),
            ]);
            $this->add('web_address', Field::TEXT);
            $this->add('web_phone', Field::TEXT);
            $this->add('web_email', Field::EMAIL);
            $this->add('ob_title', Field::TEXT);
            $this->add('ob_description', Field::TEXT);
            $this->add('ob_keyword', Field::TEXT);
        } else {
            $this->add('web_name', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('web_phone', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('web_email', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('ob_title', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('ob_description', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('ob_keyword', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('edit', Field::BUTTON_LINK, [
                'label' => trans('admin::common.edit'),
                'variant' => 'primary',
                'attr' => ['href' => route(...$this->getFormOption('route')), 'class' => ['show_modal_form' => true]]
            ]);
        }
    }
}
