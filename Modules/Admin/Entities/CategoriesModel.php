<?php

namespace Modules\Admin\Entities;

use App\Facades\Common;
use Modules\Admin\Repositories\PostsRepository;
use Modules\Admin\Traits\NestedSetCategoryTrait;
use Modules\Home\Services\HomeServices;

class CategoriesModel extends AdminBaseModel
{
    use NestedSetCategoryTrait;

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
        'category_type'
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

    // public function getPostListAttribute()
    // {
    //     return resolve(PostsRepository::class)->getAllDataByCategory($this->id, 8);
    // }
}
