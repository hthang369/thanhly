<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Facades\Breadcrumb;
use Modules\Admin\Repositories\NewsRepository;
use Modules\Admin\Validators\NewsValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class NewsController extends CoreController
{
    public function __construct(NewsRepository $repository, NewsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::news');
        // $this->setRouteName('news');
        // $this->setPathView([
        //     'create' => 'admin::news.news_modal',
        //     'show' => 'admin::news.news_modal',
        //     'update' => 'news.update',
        //     'store' => 'news.store',
        //     'destroy' => 'news.destroy',
        // ]);
    }
}
