<?php

namespace Modules\Admin\Repositories\Menus;

use Modules\Core\Entities\Menus\MenusModel;
use Modules\Admin\Facades\Menus;
use Modules\Admin\Forms\Menus\MenusForm;
use Modules\Admin\Grids\Menus\MenusGrid;
use Modules\Admin\Repositories\AdminBaseRepository;

class MenusRepository extends AdminBaseRepository
{
    use MenusCriteria;

    protected $presenterClass = MenusGrid::class;

    protected $modelClass = MenusModel::class;

    protected $formClass = MenusForm::class;

    public function create(array $attributes)
    {
        $attributes = array_except($attributes, '_token');
        if (!isset($attributes['menu_link'])) {
            $attributes['menu_link'] = str_slug($attributes['menu_name']);
        }
        $attributes['partial_id'] = data_get($attributes, $attributes['partial_table']);
        $attributes['menu_title'] = $attributes['menu_name'];
        return parent::createNestedTree($attributes);
    }

    public function update(array $attributes, $id)
    {
        $attributes = array_except($attributes, '_token');
        if (!isset($attributes['menu_link'])) {
            $attributes['menu_link'] = str_slug($attributes['menu_name']);
        }
        $attributes['partial_id'] = data_get($attributes, $attributes['partial_table']);
        $attributes['menu_title'] = $attributes['menu_name'];
        return parent::updateNestedTree($attributes, $id);
    }

    public function getMenus($menu)
    {
        $menus = $this->getDataByType($menu);
        return Menus::getSortableMenus($menus);
    }

    public function getDataByType($type)
    {
        return $this->model->where('menu_type', $type)->defaultOrder()->get([
            'id',
            'menu_name as title',
            'menu_link as link',
            'menu_icon as icon',
            'parent_id',
            'menu_lft',
            'menu_rgt',
            'route_name'
        ])->toTree();
    }

    public function updateSort(array $attributes, $id)
    {
        return $this->updateSortNestedTree($attributes, function($item) {
            return ['menu_depth' => $item['depth']];
        });
    }

    private function moveNodeUpdate($id, $position)
    {
        return $this->model->moveNode($id, $position);
    }
}
