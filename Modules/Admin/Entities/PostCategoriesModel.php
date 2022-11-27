<?php

namespace Modules\Admin\Entities;

class PostCategoriesModel extends AdminBaseModel
{
    protected $table = 'post_categories';

    protected $fillable = [
        'post_id',
        'category_id'
    ];

}
