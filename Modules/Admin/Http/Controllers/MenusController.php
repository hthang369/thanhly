<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Repositories\MenusRepository;
use Modules\Admin\Validators\MenusValidator;
use Laka\Core\Http\Controllers\CoreController;
use Laka\Core\Responses\BaseResponse;

class MenusController extends CoreController
{
    protected $actionPermissionList = [
        'view' => 'view',
        'sort' => 'edit',
    ];

    public function __construct(MenusRepository $repository, MenusValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
        // $this->setDefaultView('admin::menus');
        // $this->setRouteName('menus');
        // $this->setPathView([
        //     'view'  => 'admin::menus.index',
        //     'create' => 'admin::menus.menu_modal',
        //     'show' => 'admin::menus.menu_modal',
        //     'update' => 'menus.update',
        //     'store' => 'menus.store',
        //     'destroy' => 'menus.destroy',
        //     'sort' => 'admin::menus.sort',
        //     'updateSort' => 'admin::menus.sort',
        // ]);
    }

    public function view(Request $request, $id = null)
    {
        $menu_type = head(array_keys(config('admin.menu_type')));
        request()->merge(['type' => $id ?? $menu_type]);
        $data = $this->repository->allDataGrid();
        return $this->renderView($data, __FUNCTION__);
    }

    public function create(Request $request, $menu = null)
    {
        request()->merge(['type' => $menu]);
        return parent::create($request);
    }

    public function edit(Request $request, $id, $menu = null)
    {
        request()->merge(['type' => $menu]);
        return parent::edit($request, $id);
    }

    public function sort(Request $request, $menu = null)
    {
        $menus = $this->repository->getMenus($menu);
        return $this->renderView([$menus, $menu], __FUNCTION__);
    }

    public function updateSort(Request $request, $id)
    {
        $this->validator->setId($id);
        $this->validator($request->all(), 'update-sort');

        $data = $this->repository->updateSort($request->all(), $id);

        if (method_exists($data, 'toArray')) {
            $data = $data->toArray();
        }

        return $this->responseAction($request, $data, 'updated', '');
    }
}
