<?php

namespace Modules\Admin\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Permissions\Role;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Roles\PermissionRoleRepository;
use Modules\Admin\Validators\Roles\PermissionRoleValidator;

class PermissionRoleController extends CoreController
{
    protected $listViewName = [
        'show' => 'admin::permission_roles.show',
    ];
    
    public function __construct(PermissionRoleRepository $repository, PermissionRoleValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $this->repository->role_id = $id;
        list($grid, $data) = $this->repository->allDataGrid();
        $role_id = $id;
        $name = Role::find($id, ['name'])->name;
        return $this->renderView($request, compact('data', 'grid', 'role_id', 'name'), __FUNCTION__);
    }
}
