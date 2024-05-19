<?php

namespace Modules\Admin\Forms\Posts;

use Laka\Core\Forms\Field;
use Modules\Admin\Repositories\Posts\PostsRepository;
use Modules\Core\Forms\CoreForm;

class PostsForm extends CoreForm
{
    protected $groupLangKey = 'posts';

    public function buildForm()
    {
        $this
            ->add('post_title', Field::TEXT)
            ->add('post_excerpt', Field::TEXT)
            ->add('post_link', Field::TEXT)
            ->add('category_id[]', Field::MULTI_SELECT, [
                'label' => module_trans('posts.category_id'),
                'choices' => resolve(PostsRepository::class)->getDataTreeCategories(),
                'selected' => data_get($this->getModel(), 'category_id'),
            ])
            // ->add('tag_id[]', Field::MULTI_SELECT)
            ->add('post_image', Field::FILE)
            // ->add('attribute_preview', Field::TEXT, [
            //     'value' => data_get(data_get($this->getModel(), 'attributes')->first(), 'pivot.value')
            // ])
            ->add('post_content', Field::TEXTAREA)
            ->add('ob_title', Field::TEXT)
            ->add('ob_desception', Field::TEXT)
            ->add('ob_keyword', Field::TEXT);
    }
}
