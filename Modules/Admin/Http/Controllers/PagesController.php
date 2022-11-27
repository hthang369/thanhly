<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Facades\Breadcrumb;
use Modules\Admin\Repositories\PagesRepository;
use Modules\Admin\Validators\PagesValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class PagesController extends CoreController
{
    public function __construct(PagesRepository $repository, PagesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::pages');
        // $this->setRouteName('pages');
        // $this->setPathView([
        //     'create' => 'admin::pages.page_modal',
        //     'show' => 'admin::pages.page_modal',
        //     'update' => 'pages.update',
        //     'store' => 'pages.store',
        //     'destroy' => 'pages.destroy',
        // ]);
    }

}
