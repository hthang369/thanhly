<?php

namespace Modules\Admin\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Roles\RolesRepository;
use Modules\Admin\Validators\Roles\RolesValidator;

class RolesController extends CoreController
{
    public function __construct(RolesRepository $repository, RolesValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::roles');
        // $this->setRouteName('role');
        // $this->setPathView([
        //     'create' => 'admin::roles.role_modal',
        //     'show' => 'admin::roles.role_modal',
        //     'update' => 'role.update',
        //     'store' => 'role.store',
        //     'destroy' => 'role.destroy',
        // ]);
    }

    public function index(Request $request)
    {
        list($data, $grid) = $this->repository->newDataGrid();
        return $this->renderView($request, compact('data', 'grid'), __FUNCTION__);
    }

    public function permissionRole(Request $request, $id)
    {

    }
}
