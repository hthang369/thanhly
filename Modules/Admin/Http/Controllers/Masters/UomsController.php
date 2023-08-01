<?php

namespace Modules\Admin\Http\Controllers\Masters;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Masters\UomsRepository;
use Modules\Admin\Validators\Uoms\UomsValidator;

class UomsController extends CoreController
{
    public function __construct(UomsRepository $repository, UomsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
