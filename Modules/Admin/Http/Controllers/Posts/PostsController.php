<?php

namespace Modules\Admin\Http\Controllers\Posts;

use Laka\Core\Http\Controllers\CoreController;
use Modules\Admin\Repositories\Posts\PostsRepository;
use Modules\Admin\Validators\Posts\PostsValidator;
use Modules\Core\Responses\PostResponse;

class PostsController extends CoreController
{
    protected $listViewName = [
        'create' => 'admin::posts.post_modal',
        'show' => 'admin::posts.post_modal',
        'edit' => 'admin::posts.post_modal',
    ];

    public function __construct(PostsRepository $repository, PostsValidator $validator, PostResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
