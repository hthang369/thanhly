<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\MenusModel;
use Modules\Admin\Facades\Menus;
use Modules\Admin\Forms\MenusForm;
use Modules\Admin\Grids\MenusGrid;

class MenusRepository extends AdminBaseRepository
{
    use MenusCriteria;

    protected $presenterClass = MenusGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MenusModel::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        return MenusForm::class;
    }

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
        $menus = $this->model->where('menu_type', $menu)->defaultOrder()->get()->toTree();
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
            'menu_rgt'
        ])->toTree();
    }

    public function updateSort(array $attributes, $id)
    {
        foreach ($attributes as $item) {
            if (is_null($item['item_id'])) continue;
            $data = [
                'parent_id'  => $item['parent_id'],
                'menu_lft'   => $item['left'] - 1,
                'menu_rgt'   => $item['right'] - 1,
                'menu_depth' => $item['depth']
            ];
            parent::update($data, $item['item_id']);
        }
        return true;
    }

    private function moveNodeUpdate($id, $position)
    {
        return $this->model->moveNode($id, $position);
    }
}
