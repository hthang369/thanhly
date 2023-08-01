<?php

namespace Modules\Admin\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class ImageFileType extends FormField
{

    protected function getTemplate()
    {
        // At first it tries to load config variable,
        // and if fails falls back to loading view
        // resources/views/fields/datetime.blade.php
        return 'fields.image_file';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        data_set($options, 'attr.class', array_merge(data_get($options, 'attr.class', []), ['img-thumbnail']));
        return parent::render($options, $showLabel, $showField, $showError);
    }
}
