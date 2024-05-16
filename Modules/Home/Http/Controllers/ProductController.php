<?php

namespace Modules\Home\Http\Controllers;

use Modules\Home\Repositories\ProductRepository;
use Modules\Home\Validators\ProductValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\HomeCoreController;
use Modules\Home\Traits\HomeTrait;

class ProductController extends HomeCoreController
{
    use HomeTrait;

    public function __construct(ProductRepository $repository, ProductValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function shareDataToView($data)
    {
        parent::shareDataToView($data);
        $this->shareDataView([
            'relatedTitle' => module_trans('common.slidebar_right.popular_product'),
            'listRelated' => $this->repository->getPopularProducts(data_get($data, 'data.id'))
        ]);
    }
}
