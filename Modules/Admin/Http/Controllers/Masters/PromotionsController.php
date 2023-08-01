<?php

namespace Modules\Admin\Http\Controllers\Masters;

use Modules\Admin\Repositories\Masters\PromotionsRepository;
use Modules\Admin\Validators\Masters\PromotionsValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class PromotionsController extends CoreController
{
    public function __construct(PromotionsRepository $repository, PromotionsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
