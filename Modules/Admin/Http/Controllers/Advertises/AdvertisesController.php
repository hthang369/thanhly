<?php

namespace Modules\Admin\Http\Controllers\Advertises;

use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Advertises\AdvertisesRepository;
use Modules\Admin\Validators\Advertises\AdvertisesValidator;

class AdvertisesController extends CoreController
{
    public function __construct(AdvertisesRepository $repository, AdvertisesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::advertises');
        // $this->setRouteName('advertises');
        // $this->setPathView([
        //     'create' => 'admin::advertises.advertise_modal',
        //     'show' => 'admin::advertises.advertise_modal',
        //     'update' => 'advertises.update',
        //     'store' => 'advertises.store',
        //     'destroy' => 'advertises.destroy',
        // ]);
    }
}
