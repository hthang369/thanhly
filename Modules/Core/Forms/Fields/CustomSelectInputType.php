<?php

namespace Modules\Core\Forms\Fields;

use Laka\Core\Forms\Fields\FormField;

class CustomSelectInputType extends FormField
{
    protected function getTemplate()
    {
        // At first it tries to load config variable,
        // and if fails falls back to loading view
        // resources/views/fields/datetime.blade.php
        return 'core::fields.custom_select_input';
    }

    protected function getAttributes(array $options = [])
    {
        if (array_key_exists('empty_value', $options)) {
            data_set($options, 'attr.placeholder', $options['empty_value']);
        }
        data_set($options, 'attr.class', 'form-control');
        return $options;
    }
}
