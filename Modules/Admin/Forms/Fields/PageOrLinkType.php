<?php

namespace Modules\Admin\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class PageOrLinkType extends FormField
{
    protected function getTemplate()
    {
        // At first it tries to load config variable,
        // and if fails falls back to loading view
        // resources/views/fields/datetime.blade.php
        return 'fields.page_or_link';
    }
}
