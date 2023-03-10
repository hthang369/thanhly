<?php

namespace Modules\Setting\Http\Controllers;

use Modules\Setting\Repositories\AttributeRepository;
use Modules\Setting\Validators\AttributeValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class AttributeController extends CoreController
{
    public function __construct(AttributeRepository $repository, AttributeValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
