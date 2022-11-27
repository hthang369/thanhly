<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        return view('admin::edit');
    }
}
