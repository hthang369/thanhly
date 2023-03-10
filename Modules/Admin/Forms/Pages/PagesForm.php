<?php

namespace Modules\Admin\Forms\Pages;

use Laka\Core\Forms\Field;
use Modules\Core\Forms\CoreForm;

class PagesForm extends CoreForm
{
    protected $groupLangKey = 'pages';

    public function buildForm()
    {
        $this
            ->add('post_title', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('post_excerpt', Field::TEXT)
            ->add('post_link', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('post_image', Field::FILE)
            ->add('post_content', Field::TEXTAREA)
            ->add('ob_title', Field::TEXT)
            ->add('ob_desception', Field::TEXT)
            ->add('ob_keyword', Field::TEXT);
    }
}
