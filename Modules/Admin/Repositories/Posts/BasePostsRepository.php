<?php

namespace Modules\Admin\Repositories\Posts;

use Laka\Core\Enums\ActionStatus;
use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Admin\Repositories\Categories\CategoriesRepository;
use Modules\Core\Entities\Posts\PostCategoriesModel;

abstract class BasePostsRepository extends AdminBaseRepository
{
    protected $type;

    public function getListOfLink()
    {
        return $this->model->where('post_type', $this->type)->pluck('post_title', 'id');
    }

    public function getDataTreeCategories()
    {
        return resolve(CategoriesRepository::class)->getDataByType($this->type);
    }

    protected function upsertWithCategories(array $attributes, $id = null)
    {
        $listCategories = $attributes['category_id'];
        return $this->upsert($attributes, $id, function($result) use($listCategories, $attributes) {
            $this->upsertForenignCategories(PostCategoriesModel::class, $listCategories, $result->category_id, $result->id);
            // $this->upsertAttributes($this->attributeRelationClass, $attributes, $result->id);
        });
    }

    public function create(array $attributes)
    {
        $attributes['post_type'] = $this->type;
        $attributes['post_date'] = now();
        $attributes['is_status'] = ActionStatus::ACTIVE;
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
