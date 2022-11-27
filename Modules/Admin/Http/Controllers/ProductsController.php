<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Repositories\ProductsRepository;
use Modules\Admin\Validators\ProductsValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class ProductsController extends CoreController
{
    public function __construct(ProductsRepository $repository, ProductsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
