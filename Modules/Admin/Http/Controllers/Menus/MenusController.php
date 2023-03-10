<?php

namespace Modules\Admin\Http\Controllers\Menus;

use Illuminate\Http\Request;
use Laka\Core\Responses\BaseResponse;
use Modules\Admin\Repositories\Menus\MenusRepository;
use Modules\Admin\Validators\Menus\MenusValidator;
use Modules\Core\Http\Controllers\CoreController;

class MenusController extends CoreController
{
    protected $listViewName = [
        'view' => 'admin::menus.index',
        'sort' => 'admin::menus.sort',
    ];

    public function __construct(MenusRepository $repository, MenusValidator $validator, BaseResponse $response)
    {
        parent::__construct($repository, $validator, $response);
    }

    public function view(Request $request, $id = null)
    {
        $menu_type = head(array_keys(config('admin.menu_type')));
        $request->merge(['type' => $id ?? $menu_type]);
        list($grid, $data) = $this->repository->allDataGrid();
        return $this->renderView($request, compact('grid', 'data'), __FUNCTION__);
    }

    public function create(Request $request, $menu = null)
    {
        $request->merge(['type' => $menu]);
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
        return $this->renderView($request, compact('menus', 'menu'), __FUNCTION__);
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
