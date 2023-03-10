<?php

namespace Modules\Admin\Http\Controllers\Pages;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Pages\PagesRepository;
use Modules\Admin\Validators\Pages\PagesValidator;

class PagesController extends CoreController
{
    protected $listViewName = [
        'create' => 'admin::pages.page_modal',
        'show' => 'admin::pages.page_modal',
        'edit' => 'admin::pages.page_modal',
    ];

    public function __construct(PagesRepository $repository, PagesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

}
