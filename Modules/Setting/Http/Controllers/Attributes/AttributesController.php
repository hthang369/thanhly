<?php

namespace Modules\Setting\Http\Controllers\Attributes;

use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Setting\Repositories\Attributes\AttributesRepository;
use Modules\Setting\Validators\Attributes\AttributesValidator;

class AttributesController extends CoreController
{
    protected $listViewName = [
        'sort'     => 'setting::attributes.sort',
    ];

    public function __construct(AttributesRepository $repository, AttributesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
