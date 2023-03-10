<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Home\Repositories\CategoryRepository;
use Modules\Home\Traits\HomeTrait;
use Modules\Home\Validators\CategoryValidator;

class CategoryController extends CoreController
{
    use HomeTrait;
    
    protected $permissionActions = [
        'index' => 'public',
        'show' => 'public'
    ];

    public function __construct(CategoryRepository $repository, CategoryValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $info = $this->repository->show($id);
        $result = [
            'header_title' => $info->category_name,
            'info' => $info
        ];
        $viewName = 'index';
        $this->shareDataView($info->category_type);
        return $this->response->data(request(), compact('result'), 'home::category.'.$viewName);
    }
}
