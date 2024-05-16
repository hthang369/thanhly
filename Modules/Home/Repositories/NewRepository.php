<?php

namespace Modules\Home\Repositories;

use Modules\Core\Entities\News\NewsModel;
use Modules\Core\Repositories\HomeCoreRepository;

class NewRepository extends HomeCoreRepository
{
    protected $modelClass = NewsModel::class;

    public function showInternal($id, $viewName)
    {
        list($info, $listPopular) = $this->findPost($id);
        $info->header_title = $info->post_title;
        return ['data' => $info, 'view' => $viewName, 'listPopular' => $listPopular];
    }

    public function findPost($id)
    {
        return $this->findDocument($this->model, 'post_link', $id, 'post_categories', 'post_id', 'post_date', [], [
            'post_title as title',
            'post_link as link',
            'post_image as image',
            'post_excerpt as excerpt'
        ]);
    }
}
