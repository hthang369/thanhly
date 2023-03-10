<?php

namespace Modules\Admin\Repositories\Posts;

use Closure;
use Illuminate\Support\Facades\DB;
use Laka\Core\Enums\ActionStatus;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Admin\Repositories\AdminBaseRepository;

abstract class BasePostsRepository extends AdminBaseRepository
{
    protected $type;

    public function getListOfLink()
    {
        return $this->model->where('post_type', $this->type)->pluck('post_title', 'id');
    }

    public function getDataTreeCategories()
    {
        return resolve(CategoriesModel::class)->getDataByType($this->type);
    }

    protected function upsertWithCategories(array $attributes, $id = null)
    {
        $listCategories = $attributes['category_id'];
        return $this->upsert($attributes, $id, function($result) use($listCategories, $attributes) {
            $this->upsertForenignCategories(PostCategoriesRepository::class, $listCategories, $result->id);
            $this->upsertAttributes($this->attributeRelationClass, $attributes, $result->id);
        });
    }

    public function create(array $attributes)
    {
        $attributes['post_type'] = $this->type;
        $attributes['post_date'] = now();
        $attributes['post_status'] = ActionStatus::ACTIVE;
        $attributes['author_id'] = user_get('id');
        if (array_has($attributes, 'category_id')) {
            return $this->upsertWithCategories($attributes);
        }
        return parent::create($attributes);
    }

    public function update(array $attributes, $id)
    {
        if (array_has($attributes, 'category_id')) {
            return $this->upsertWithCategories($attributes, $id);
        }
        return parent::update($attributes, $id);
    }
}
