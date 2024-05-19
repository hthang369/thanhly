<?php

namespace Modules\Admin\Http\Controllers\Pages;

use Laka\Core\Http\Controllers\CoreController;
use Modules\Admin\Repositories\Pages\PagesRepository;
use Modules\Admin\Validators\Pages\PagesValidator;
use Modules\Core\Responses\PostResponse;

class PagesController extends CoreController
{
    protected $listViewName = [
        'create' => 'admin::posts.post_modal',
        'show' => 'admin::posts.post_modal',
        'edit' => 'admin::posts.post_modal',
    ];

    public function __construct(PagesRepository $repository, PagesValidator $validator, PostResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

}
