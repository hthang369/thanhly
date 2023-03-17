<?php

namespace Modules\WebDesign\Http\Controllers;

use Modules\WebDesign\Repositories\PostRepository;
use Modules\WebDesign\Validators\PostValidator;
use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\HomeCoreController;

class PostController extends HomeCoreController
{
    public function __construct(PostRepository $repository, PostValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
