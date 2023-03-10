<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Home\Repositories\HomeRepository;
use Modules\Home\Responses\HomeResponse;
use Modules\Home\Validators\HomeValidator;
use Modules\Setting\Facade\Setting;
use Laka\Core\Http\Controllers\BaseController;
use Modules\Home\Traits\HomeTrait;

class HomeController extends BaseController
{
    use HomeTrait;

    protected $permissionActions = [
        'index' => 'public',
        'show' => 'public',
        'sendMail' => 'public'
    ];

    public function __construct(HomeRepository $repository, HomeValidator $validator, HomeResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = $this->repository->show('/');
        $this->sharePageTitle(module_trans('common.page_title.home'));
        return $this->response->data(request(), ['result' => $data['data']], 'home::index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $base = $this->repository->show($id);
        if (!array_has($base, 'data.ob_desception')) {
            data_set($base, 'data.ob_desception', Setting::get('info', 'ob_desception'));
        }
        $viewName = $base['view_name'];
        if (blank($viewName)) $viewName = 'show';
        $this->sharePageTitle(data_get($base, 'data.header_title'));
        $this->shareDataView($base['data']->category_type);

        return $this->response->data(request(), ['result' => $base['data']], "home::{$viewName}");
    }

    public function sendMail(Request $request)
    {
        $base = $this->repository->sendMail($request->all());

        return $this->response->created($request, $base);
    }

    public function showPost($id)
    {
        $base = $this->repository->findPostCategory($id);

        $viewName = 'category';
        $this->data['mapInfo'] = data_get($this->allSetting, 'map.web_map');

        return view("home::$viewName", array_merge($this->data, $base));
    }

    public function showPostDetail(Request $request, $id)
    {
        list($postInfo, $popularPost) = $this->repository->findPost($id);
        
        $viewName = 'show';

        return $this->response->data($request, compact('postInfo', 'popularPost'), "home::$viewName");
    }
}
