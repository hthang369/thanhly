<?php

namespace Modules\Admin\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class MapFieldType extends FormField
{

    protected function getTemplate()
    {
        // At first it tries to load config variable,
        // and if fails falls back to loading view
        // resources/views/fields/datetime.blade.php
        return 'fields.maps';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        data_set($options, 'attr.class', array_merge(data_get($options, 'attr.class', []), ['embed-responsive-item']));
        data_set($options, 'attr.parent_class', 'embed-responsive-16by9');
        return parent::render($options, $showLabel, $showField, $showError);
    }
}
