<?php

namespace Modules\Core\Entities\Categories;

use Modules\Core\Entities\CoreModel;
use Modules\Core\Entities\News\NewsModel;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Core\Traits\ActionScopeTrait;
use Modules\Core\Traits\NestedSetCategoryTrait;

class CategoriesModel extends CoreModel
{
    use NestedSetCategoryTrait, ActionScopeTrait;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'category_excerpt',
        'category_link',
        'category_image',
        'parent_id',
        'category_lft',
        'category_rgt',
        'ob_title',
        'ob_desception',
        'ob_keyword',
        'category_status',
        'category_type',
        'view_name'
    ];

    protected $slugColumn = [
        'category_link' => 'category_name'
    ];

    protected $seoMetaColumn = [
        'ob_title' => 'category_name'
    ];

    public function getDataByType($type)
    {
        $results = $this->where('category_type', $type)->defaultDepthNestedTree()->get(['id', 'category_name', 'depth']);
        $data = $results->mapToDictionary(function($item, $key) {
            return [data_get($item, 'id') => str_repeat('-- ', data_get($item, 'depth')).data_get($item, 'category_name')];
        })->map(function($item) {
            return head($item);
        });

        return $data->toArray();
    }

    public function posts()
    {
        return $this->belongsToMany(PostsModel::class, 'post_categories', 'category_id', 'post_id');
    }

    public function news()
    {
        return $this->belongsToMany(NewsModel::class, 'post_categories', 'category_id', 'post_id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductsModel::class, 'product_categories', 'category_id', 'product_id');
    }

    // public function getPostListAttribute()
    // {
    //     return resolve(PostsRepository::class)->getAllDataByCategory($this->id, 8);
    // }
}
