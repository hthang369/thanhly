<?php

namespace Modules\Admin\Http\Controllers\Uoms;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Uoms\UomsRepository;
use Modules\Admin\Validators\Uoms\UomsValidator;

class UomsController extends CoreController
{
    public function __construct(UomsRepository $repository, UomsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
