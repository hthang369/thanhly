<?php

namespace Modules\Admin\Http\Controllers\Advertises;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Advertises\SlidesRepository;
use Modules\Admin\Validators\Advertises\SlidesValidator;

class SlidesController extends CoreController
{
    public function __construct(SlidesRepository $repository, SlidesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::slides');
        // $this->setRouteName('slides');
        // $this->setPathView([
        //     'create' => 'admin::slides.slide_modal',
        //     'show' => 'admin::slides.slide_modal',
        //     'update' => 'slides.update',
        //     'store' => 'slides.store',
        //     'destroy' => 'slides.destroy',
        // ]);
    }

    // public function store(Request $request)
    // {
    //     print_r($request->all());
    // }
}
