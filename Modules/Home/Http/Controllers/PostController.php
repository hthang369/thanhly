<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Home\Repositories\PostRepository;
use Modules\Home\Validators\PostValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\HomeCoreController;
use Modules\Home\Traits\HomeTrait;

class PostController extends HomeCoreController
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

    public function shareDataToView($data)
    {
        parent::shareDataToView($data);
        $this->shareDataView([
            'relatedTitle' => module_trans('common.slidebar_right.popular_header'),
            'listRelated' => $data['listPopular']
        ]);
    }
}
