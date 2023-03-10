<?php

namespace Modules\Admin\Repositories\Posts;

use Closure;
use Illuminate\Support\Facades\DB;
use Laka\Core\Support\FileManagementService;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Admin\Forms\Posts\PostsForm;
use Modules\Admin\Grids\Posts\PostsGrid;
use Modules\Core\Entities\Posts\PostAttributesModel;
use Modules\Core\Enums\PostType;

class PostsRepository extends BasePostsRepository
{
    use PostsCriteria;

    protected $type = PostType::POST;

    protected $imageColumnName = 'post_image';

    protected $presenterClass = PostsGrid::class;

    protected $modelClass = PostsModel::class;

    protected $formClass = PostsForm::class;

    protected $serviceClass = FileManagementService::class;

    protected $attributeRelationClass = PostAttributesModel::class;

    public function getAllDataByCategory($id, $type = 'post')
    {
        $limit = 15;
        $query = $this->model::select(['posts.*', 'category_id', 'post_image'])
            ->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->where('post_type', $type)
            ->where('category_id', $id);

        return $query->paginate($limit);
    }

    public function getAllDataByCategoryParent($id, $limit = 0)
    {
        $query = $this->model::select(['posts.*', 'category_id', 'post_image', 'category_name', 'category_link', 'category_image'])
            ->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->join('categories', 'post_categories.category_id', '=', 'categories.id')
            ->leftJoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->where('categories.parent_id', $id);
        if ($limit > 0)
            $query->limit($limit);

        return $query->get();
    }

    public function getAllDataWithCategoryParent($id)
    {
        $mainQuery = clone $this->model;
        $subQuery = clone $this->model;
        $query = $this->model::select(['posts.*', 'category_id', 'post_image', 'category_name', 'category_link', 'category_image'])
            ->join('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->join('categories', 'post_categories.category_id', '=', 'categories.id')
            ->leftJoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->where('categories.parent_id', $id)
            ->orderBy('post_date', 'desc');

        return $mainQuery->select(['tmp1.*'])
            ->fromSub($subQuery->select([
                    DB::raw('ROW_NUMBER() over(PARTITION By category_id) stt'),
                    'tmp.*'
                ])
                ->fromSub($query, 'tmp'), 'tmp1')
            ->where('stt', '<=', 8)
            ->get();
    }

    // protected function upsert(array $attributes, $id = null, Closure $callback = null)
    // {
    //     $dataAttribute = [data_get($attributes, 'attribute_preview')];
    //     return parent::upsert($attributes, $id, function($result) use($callback, $dataAttribute) {
    //         if (!blank($callback) && is_callable($callback))
    //             with($result, $callback);

    //         $this->upsertForenignColumn(resolve(PostAttributesRepository::class), $dataAttribute, $result->id, 'attribute_id');
    //     });
    // }


}
