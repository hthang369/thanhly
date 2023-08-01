<?php

namespace Modules\Admin\Http\Controllers\Categories;

use Illuminate\Http\Request;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Enums\CategoryType;
use Modules\Admin\Repositories\Categories\CategoriesRepository;
use Modules\Admin\Validators\Categories\CategoriesValidator;
use Modules\Core\Http\Controllers\CoreController;

class CategoriesController extends CoreController
{
    protected $permissionActions = [
        'viewIndex' => 'view',
        'viewEdit' => 'edit'
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
        return $this->viewIndex($request, CategoryType::PRODUCT);
    }

    public function viewNews(Request $request)
    {
        return $this->viewIndex($request, CategoryType::NEWS);
    }

    public function viewPost(Request $request)
    {
        return $this->viewIndex($request, CategoryType::POST);
    }

    public function create(Request $request, $type = null)
    {
        $request->merge(['category_type' => $type]);
        return parent::create($request);
    }

    public function viewEdit(Request $request, $type, $id)
    {
        $request->merge(['category_type' => $type]);
        return parent::edit($request, $id);
    }
}
