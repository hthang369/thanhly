<?php

namespace Modules\WebDesign\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Laka\Core\Responses\BaseResponse;
use Modules\Core\Http\Controllers\HomeCoreController;
use Modules\Setting\Facade\Setting;
use Modules\WebDesign\Repositories\WebDesignRepository;
use Modules\WebDesign\Traits\WebDesignTrait;
use Modules\WebDesign\Validators\WebDesignValidator;

class WebDesignController extends HomeCoreController
{
    protected $permissionActions = [
        'index' => 'public',
        'show' => 'public',
        'sendMail' => 'public'
    ];

    public function __construct(WebDesignRepository $repository, WebDesignValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $infoSetting = Setting::getAllSetting()->get('info');
        $this->sharePageTitle(data_get($infoSetting, 'ob_title'));
        $data = $this->repository->show('/');
        return view(module_view_name(__FUNCTION__), $data['data']);
    }

    public function sendMail(Request $request)
    {
        $base = $this->repository->sendMail($request->all());

        return $this->response->created($request, $base);
    }

    public function showPost(Request $request, $id)
    {
        $base = $this->repository->findPostCategory($id);
        $this->sharePageTitle(data_get($base, 'ob_title'));

        $viewName = 'category';

        return $this->response->data($request, ['result' => $base], "webdesign::$viewName");
    }

    public function showPostDetail(Request $request, $id)
    {
        $base = $this->repository->findPost($id);
        $this->sharePageTitle(data_get($base, 'ob_title'));
        $viewName = 'show';

        return $this->response->data($request, ['result' => $base], "webdesign::$viewName");
    }

    public function showProductDetail(Request $request, $id)
    {
        $base = $this->repository->findProduct($id);
        $this->sharePageTitle(data_get($base, 'ob_title'));
        $viewName = 'show_product';

        return $this->response->data($request, ['result' => $base], "webdesign::$viewName");
    }
}
