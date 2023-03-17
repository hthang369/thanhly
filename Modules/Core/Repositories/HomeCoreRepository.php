<?php

namespace Modules\Core\Repositories;

use Laka\Core\Repositories\CoreRepository as BaseCoreRepository;
use Modules\Core\Entities\Menus\MenusModel;

abstract class HomeCoreRepository extends BaseCoreRepository
{
    public function show($id, $columns = [])
    {
        $menu = MenusModel::where('menu_link', $id)->first();
        $menuView = data_get($menu, 'menu_view');
        $docType = ucfirst(data_get($menu, 'partial_table', 'internal'));
        $docId = data_get($menu, 'partial_id');
        $method = "show{$docType}";
        return $this->$method($docId ?? $id, $menuView);
    }
}
