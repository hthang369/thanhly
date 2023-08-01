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

    public function shareDataToView($data)
    {
        parent::shareDataToView($data);
        $this->shareDataView([
            'sidebarHeader' => module_trans('common.slidebar_right.popular_header'),
            'listPopular' => resolve(HomeServices::class)->getPostPopulars()   
        ]);
    }
}
