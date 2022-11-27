<?php

namespace Modules\Setting\Forms;

use Laka\Core\Forms\Field;
use Laka\Core\Forms\Form;

class SettingsHomeForm extends Form
{
    public function buildForm()
    {
        if ($this->getData('action') == 'edit') {
            $this->add('web_favicon', Field::FILE, [
                'label' => trans('setting::configs.web_favicon'),
            ]);
            $this->add('web_logo', Field::FILE, [
                'label' => trans('setting::configs.web_logo'),
            ]);
            $this->add('web_banner', Field::FILE, [
                'label' => trans('setting::configs.web_banner'),
            ]);
            $this->add('save_info', Field::BUTTON_SUBMIT, [
                'label' => trans('setting::configs.save_info'),
                'attr' => ['class' => 'btn btn-success']
            ]);
            $this->add('cancel_info', Field::BUTTON_SUBMIT, [
                'label' => trans('setting::configs.cancel_info'),
                'attr' => ['class' => 'btn btn-secondary', 'formaction' => route('setting.index'), 'formmethod' => 'get']
            ]);
        } else {
            $this->add('web_favicon', Field::PICTURE, [
                'label' => trans('setting::configs.web_favicon'),
                'url' => 'public/storage/images/',
                'width' => '150',
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-4']],
                'field_attr' => ['class' => ['col-8']]
            ]);
            $this->add('web_logo', Field::PICTURE, [
                'label' => trans('setting::configs.web_logo'),
                'url' => 'public/storage/images/',
                'width' => '150',
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-4']],
                'field_attr' => ['class' => ['col-8']]
            ]);
            $this->add('web_banner', Field::PICTURE, [
                'label' => trans('setting::configs.web_banner'),
                'url' => 'public/storage/images/',
                'width' => '150',
                'wrapper' => ['inline' => true],
                'label_attr' => ['class' => ['col-4']],
                'field_attr' => ['class' => ['col-8']]
            ]);
            $this->add('edit', Field::BUTTON_SUBMIT, [
                'label' => trans('admin::common.edit'),
                'attr' => ['class' => 'btn btn-primary']
            ]);
        }
    }
}
