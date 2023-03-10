<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Home\Repositories\PostRepository;
use Modules\Home\Validators\PostValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Home\Traits\HomeTrait;

class PostController extends CoreController
{
    use HomeTrait;
    
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
    public function show(Request $request, $id)
    {
        $base = $this->repository->show($id);
        $result = $base['data'];
        $result->header_title = $result->post_title;
        $viewName = $base['view'];
        $type = $base['data']->category_id->pluck('category_type')->unique()->first();
        $this->shareDataView($type, 'listPopular', $base['listPopular']);
        return $this->response->data(request(), compact('result'), module_view_name("posts.{$viewName}"));
    }
}
