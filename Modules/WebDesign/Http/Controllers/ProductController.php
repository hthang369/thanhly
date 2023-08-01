<?php

namespace Modules\WebDesign\Http\Controllers;

use Illuminate\Http\Request;
use Modules\WebDesign\Repositories\ProductRepository;
use Modules\WebDesign\Validators\ProductValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\HomeCoreController;

class ProductController extends HomeCoreController
{
    protected $permissionActions = [
        'show' => 'public',
        'preview' => 'public'
    ];
    
    public function __construct(ProductRepository $repository, ProductValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function preview(Request $request, $id)
    {
        $info = $this->repository->findProduct($id);
        $folder = data_get($info->attributes->first(), 'pivot.value');
        return $this->response->data($request, ['result' => $folder], module_view_name('preview'));
    }
}
