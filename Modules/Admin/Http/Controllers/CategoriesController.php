<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Admin\Repositories\CategoriesRepository;
use Modules\Admin\Validators\CategoriesValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class CategoriesController extends CoreController
{
    protected $permissionActions = [
        'viewIndex' => 'view'
    ];
    protected $listViewName = [
        'show' => 'admin::categories.category_modal',
        'update' => 'categories.update',
        'store' => 'categories.store',
        'destroy' => 'categories.destroy',
    ];

    public function __construct(CategoriesRepository $repository, CategoriesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function viewIndex(Request $request, $type)
    {
        $request->merge(['category_type' => $type]);
        return parent::index($request);
    }

    public function viewProduct(Request $request)
    {
        return $this->viewIndex($request, 'product');
    }

    public function viewNews(Request $request)
    {
        return $this->viewIndex($request, 'news');
    }

    public function viewPost(Request $request)
    {
        return $this->viewIndex($request, 'post');
    }

    public function create(Request $request, $type = null)
    {
        $request->merge(['category_type' => $type]);
        return parent::create($request);
    }
}
