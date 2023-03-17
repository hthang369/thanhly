<?php

namespace Modules\WebDesign\Repositories;

use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Repositories\HomeCoreRepository;

class PostRepository extends HomeCoreRepository
{
    protected $modelClass = PostsModel::class;

    public function showPost($id, $viewName)
    {
        return [
            'view_name' => $viewName,
            'data' => $this->find($id)
        ];
    }

    public function showInternal($id, $viewName)
    {
        return [
            'view_name' => $viewName,
            'data' => $this->model->withoutGlobalScope('doc_type')->where('post_link', $id)->first()
        ];
    }
}
