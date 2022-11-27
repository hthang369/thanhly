<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Repositories\BrandsRepository;
use Modules\Admin\Validators\BrandsValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class BrandsController extends CoreController
{
    public function __construct(BrandsRepository $repository, BrandsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
