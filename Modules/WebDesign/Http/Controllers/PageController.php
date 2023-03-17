<?php

namespace Modules\WebDesign\Http\Controllers;

use Modules\WebDesign\Repositories\PageRepository;
use Modules\WebDesign\Validators\PageValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\HomeCoreController;

class PageController extends HomeCoreController
{
    public function __construct(PageRepository $repository, PageValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
