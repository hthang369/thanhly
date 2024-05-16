<?php

namespace Modules\Home\Http\Controllers;

use Modules\Home\Repositories\PageRepository;
use Modules\Home\Validators\PageValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\HomeCoreController;
use Modules\Home\Services\HomeServices;
use Modules\Home\Traits\HomeTrait;

class PageController extends HomeCoreController
{
    use HomeTrait;

    public function __construct(PageRepository $repository, PageValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
