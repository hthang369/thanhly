<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Repositories\NewsRepository;
use Modules\Api\Responses\NewsResponse;
use Modules\Api\Validators\NewsValidator;
use Laka\Core\Http\Controllers\BaseController;

class NewsController extends BaseController
{
    protected $actionPermissionList = [
        'listNews' => 'public',
        'showNews' => 'public'
    ];

    public function __construct(NewsRepository $repository, NewsValidator $validator, NewsResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function listNews()
    {
        return parent::index();
    }

    public function showNews($id)
    {
        return parent::show($id);
    }
}
