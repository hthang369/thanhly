<?php

namespace Modules\WebDesign\Repositories;

use Modules\Core\Entities\Pages\PagesModel;
use Modules\Core\Repositories\HomeCoreRepository;

class PageRepository extends HomeCoreRepository
{
    protected $modelClass = PagesModel::class;
    
    public function showPage($id, $viewName)
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
            'data' => $this->findByField('post_link', $id)->first()
        ];
    }

    public function showCategory($id, $viewName)
    {
        return app(CategoryRepository::class)->showCategory($id, $viewName);
    }
}
