<?php

namespace Modules\Admin\Forms\Fields;

use Laka\Core\Forms\Fields\FormField;
class PageOrLinkType extends FormField
{
    protected function getTemplate()
    {
        // At first it tries to load config variable,
        // and if fails falls back to loading view
        // resources/views/fields/datetime.blade.php
        return 'admin::fields.page_or_link';
    }

    protected function getAttributes(array $options = [])
    {
        return [
            'class' => 'form-control',
        ];
    }
}
