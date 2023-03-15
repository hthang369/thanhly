<?php

namespace Modules\Core\Entities\News;

use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\Posts\BasePostsModel;
use Modules\Core\Enums\PostType;

class NewsModel extends BasePostsModel
{
    protected static $type = PostType::NEWS;

    public function category_id()
    {
        return $this->belongsToMany(CategoriesModel::class, 'post_categories', 'post_id', 'category_id')->orderBy('category_lft');
    }
}
