<?php

namespace Modules\WebDesign\Http\Controllers;

use Modules\WebDesign\Repositories\CategoryRepository;
use Modules\WebDesign\Validators\CategoryValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class CategoryController extends CoreController
{
    protected $permissionActions = [
        'show' => 'public',
    ];

    public function __construct(CategoryRepository $repository, CategoryValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
}
