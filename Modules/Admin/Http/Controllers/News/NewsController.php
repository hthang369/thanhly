<?php

namespace Modules\Admin\Http\Controllers\News;

use Laka\Core\Http\Controllers\CoreController;
use Modules\Admin\Repositories\News\NewsRepository;
use Modules\Admin\Validators\News\NewsValidator;
use Modules\Core\Responses\PostResponse;

class NewsController extends CoreController
{
    protected $listViewName = [
        'create' => 'admin::posts.post_modal',
        'show' => 'admin::posts.post_modal',
        'edit' => 'admin::posts.post_modal',
    ];
    public function __construct(NewsRepository $repository, NewsValidator $validator, PostResponse $response)
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
