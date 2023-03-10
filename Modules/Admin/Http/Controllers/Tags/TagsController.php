<?php

namespace Modules\Admin\Http\Controllers\Tags;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Tags\TagsRepository;
use Modules\Admin\Validators\Tags\TagsValidator;

class TagsController extends CoreController
{
    public function __construct(TagsRepository $repository, TagsValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
