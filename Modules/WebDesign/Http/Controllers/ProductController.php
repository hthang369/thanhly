<?php

namespace Modules\WebDesign\Http\Controllers;

use Modules\WebDesign\Repositories\ProductRepository;
use Modules\WebDesign\Validators\ProductValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class ProductController extends CoreController
{
    protected $permissionActions = [
        'show' => 'public',
    ];
    
    public function __construct(ProductRepository $repository, ProductValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
