<?php

namespace Modules\Setting\Forms\Settings;

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
            $this->add('edit', Field::BUTTON_LINK, [
                'label' => trans('admin::common.edit'),
                'variant' => 'primary',
                'attr' => ['href' => route(...$this->getFormOption('route')), 'class' => ['show_modal_form' => true]]
            ]);
        }
    }
}
