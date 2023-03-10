<?php

namespace Modules\Admin\Http\Controllers\Products;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Products\ProductsRepository;
use Modules\Admin\Validators\Products\ProductsValidator;

class ProductsController extends CoreController
{
    protected $listViewName = [
        'create' => 'admin::products.product_modal',
        'show' => 'admin::products.product_modal',
        'edit' => 'admin::products.product_modal',
    ];

    public function __construct(ProductsRepository $repository, ProductsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
