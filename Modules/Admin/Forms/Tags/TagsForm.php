<?php

namespace Modules\Admin\Forms\Tags;

use Laka\Core\Forms\Field;
use Modules\Core\Forms\CoreForm;

class TagsForm extends CoreForm
{
    protected $groupLangKey = 'tags';

    public function buildForm()
    {
        $this->addRequired('name', Field::TEXT);
    }
}
