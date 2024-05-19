<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Validators\AdminValidator;
use Laka\Core\Http\Controllers\BaseController;
use Laka\Core\Responses\BaseResponse;

class AdminController extends BaseController
{
    public function __construct(AdminRepository $repository, AdminValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = []; //$this->repository->getWatherInfo();
        return $this->responseView(request(), $data, 'admin::index');
    }

    public function storageLink(Request $request)
    {
        // Artisan::call('storage:link', ['--force' => true]);
        $this->repository->getDirectories();
        return $this->responseView(request(), [], 'admin::storage-link');
    }

    public function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
    }
}
