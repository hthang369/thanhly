<?php

namespace Modules\Admin\Http\Controllers\Masters;

use Modules\Admin\Repositories\Masters\CurrenciesRepository;
use Modules\Admin\Validators\Masters\CurrenciesValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class CurrenciesController extends CoreController
{
    public function __construct(CurrenciesRepository $repository, CurrenciesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
