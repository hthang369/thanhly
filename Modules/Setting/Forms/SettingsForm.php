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
            $this->add('ob_desception', Field::TEXT);
            $this->add('ob_keyword', Field::TEXT);
            $this->add('save_info', Field::BUTTON_SUBMIT, [
                'label' => trans('setting::configs.save_info'),
                'attr' => ['class' => 'btn btn-success']
            ]);
            $this->add('cancel_info', Field::BUTTON_SUBMIT, [
                'label' => trans('setting::configs.cancel_info'),
                'attr' => ['class' => 'btn btn-secondary', 'formaction' => route('setting.index'), 'formmethod' => 'get']
            ]);
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
            $this->add('ob_desception', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('ob_keyword', Field::STATIC, [
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-3']],
                'attr' => ['class' => ['col-9', 'text-white']]
            ]);
            $this->add('edit', Field::BUTTON_SUBMIT, [
                'label' => trans('admin::common.edit'),
                'attr' => ['class' => 'btn btn-primary']
            ]);
        }
    }
}
