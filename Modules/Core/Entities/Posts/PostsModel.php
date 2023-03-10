<?php

namespace Modules\Core\Entities\Posts;

use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Setting\Entities\AttributeModel;

class PostsModel extends BasePostsModel
{
    protected $fillableColumns = [
        'id',
        'post_title',
        'post_image',
        'post_excerpt',
        'post_date',
        'post_status'
    ];

    public function category_id()
    {
        return $this->belongsToMany(CategoriesModel::class, 'post_categories', 'post_id', 'category_id')->orderBy('category_lft');
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeModel::class, 'post_attributes', 'post_id', 'attribute_id')
            ->select(['attributes.key', 'attributes.language', 'post_attributes.value as pivot_value']);
    }
}
