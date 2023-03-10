<?php

namespace Modules\Admin\Http\Controllers\Brands;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Brands\BrandsRepository;
use Modules\Admin\Validators\Brands\BrandsValidator;

class BrandsController extends CoreController
{
    public function __construct(BrandsRepository $repository, BrandsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
