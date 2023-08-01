<?php

namespace Modules\Admin\Http\Controllers\Masters;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Masters\VariantsRepository;
use Modules\Admin\Validators\Masters\VariantsValidator;

class VariantsController extends CoreController
{
    public function __construct(VariantsRepository $repository, VariantsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
