<?php

namespace Modules\Admin\Entities;

class PostsModel extends AdminBaseModel
{
    protected $table = 'posts';

    protected $fillable = [
        'author_id',
        'post_title',
        'post_excerpt',
        'post_name',
        'post_date',
        'post_link',
        'post_content',
        'post_image',
        'ob_title',
        'ob_desception',
        'ob_keyword',
        'post_type',
        'post_status'
    ];

    protected $fillableColumns = [
        'id',
        'post_title',
        'post_image',
        'post_excerpt',
        'post_status'
    ];

    public function getCategoryIdAttribute()
    {
        return data_get(PostCategoriesModel::where('post_id', $this->id)->first(['category_id']), 'category_id');
    }
}
