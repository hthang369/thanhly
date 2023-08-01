<?php

namespace Modules\Home\Repositories;

use Modules\Core\Entities\Pages\PagesModel;
use Modules\Core\Repositories\HomeCoreRepository;

class PageRepository extends HomeCoreRepository
{
    protected $modelClass = PagesModel::class;
    
    public function showPage($id, $viewName)
    {
        $info = $this->find($id);
        $info->header_title = $info->post_title;
        return [
            'view_name' => $viewName,
            'data' => $info
        ];
    }

    public function showInternal($id, $viewName)
    {
        $info = $this->findByField('post_link', $id)->first();
        $info->header_title = $info->post_title;
        return [
            'view_name' => $viewName,
            'data' => $info
        ];
    }

    public function showCategory($id, $viewName)
    {
        return app(CategoryRepository::class)->showCategory($id, $viewName);
    }
}
