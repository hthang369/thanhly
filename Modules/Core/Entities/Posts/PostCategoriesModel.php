<?php

namespace Modules\Core\Entities\Posts;

use Laka\Core\Entities\BaseModel;

class PostCategoriesModel extends BaseModel
{
    protected $table = 'post_categories';

    protected $fillable = [
        'post_id',
        'category_id'
    ];

}
