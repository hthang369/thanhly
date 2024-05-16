<?php

namespace Modules\Core\Entities\Posts;

use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Enums\PostType;
use Modules\Setting\Entities\Attributes\AttributesModel;

class PostsModel extends BasePostsModel
{
    protected static $type = PostType::POST;

    protected $fillableColumns = [
        'id',
        'post_title',
        'post_image',
        'post_excerpt',
        'post_date',
        'is_status'
    ];

    public function category_id()
    {
        return $this->belongsToMany(CategoriesModel::class, 'post_categories', 'post_id', 'category_id')->orderBy('category_lft');
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributesModel::class, 'post_attributes', 'post_id', 'attribute_id')
            ->select(['attributes.key', 'attributes.language', 'post_attributes.value as pivot_value']);
    }
}
