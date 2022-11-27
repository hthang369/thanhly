<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\View;
use Modules\Admin\Facades\Breadcrumb;
use Modules\Admin\Repositories\PostsRepository;
use Modules\Admin\Validators\PostsValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class PostsController extends CoreController
{
    public function __construct(PostsRepository $repository, PostsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::posts');
        // $this->setRouteName('posts');
        // $this->setPathView([
        //     'create' => 'admin::posts.post_modal',
        //     'show' => 'admin::posts.post_modal',
        //     'update' => 'posts.update',
        //     'store' => 'posts.store',
        //     'destroy' => 'posts.destroy',
        // ]);
    }

}
