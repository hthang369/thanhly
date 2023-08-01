<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Enums\CategoryType;
use Modules\Core\Http\Controllers\HomeCoreController;
use Modules\Home\Repositories\CategoryRepository;
use Modules\Home\Traits\HomeTrait;
use Modules\Home\Validators\CategoryValidator;

class CategoryController extends HomeCoreController
{
    use HomeTrait;
    
    public function __construct(CategoryRepository $repository, CategoryValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function showBrand(Request $request, $title, $brand)
    {
        $base = $this->repository->showCategoryBrand($title, $brand);
        $this->shareDataToView($base);
        $viewName = $base['view_name'];
        return $this->response->data($request, ['data' => $base['data']], module_view_name($viewName));
    }
}
