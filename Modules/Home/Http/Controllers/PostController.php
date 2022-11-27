<?php

namespace Modules\Home\Http\Controllers;

use Modules\Home\Repositories\PostRepository;
use Modules\Home\Validators\PostValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class PostController extends CoreController
{
    protected $permissionActions = [
        'index' => 'public',
        'show' => 'public'
    ];

    public function __construct(PostRepository $repository, PostValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $result = $this->repository->findByField('post_link', $id, ['post_title', 'post_image', 'post_content'])->first();
        $viewName = 'index';
        return $this->response->data(request(), compact('result'), 'home::posts.'.$viewName);
    }
}
