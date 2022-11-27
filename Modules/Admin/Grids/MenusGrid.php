<?php

namespace Modules\Admin\Grids;

use Collective\Html\FormFacade;
use Modules\Admin\Entities\MenusModel;
use Modules\Admin\Facades\Menus;

class MenusGrid extends BaseGrid
{
    /**
     * The name of the grid
     *
     * @var string
     */
    protected $name = 'Menus';

    protected $shouldRenderFilters = false;

    /**
    * Set the columns to be displayed.
    *
    * @return void
    * @throws \Exception if an error occurs during parsing of the data
    */
    public function setColumns()
    {
        return [
            [
                'key' => 'menu_name',
                'label' => trans('admin::menus.menu_name'),
            ],
            [
                'key' => 'parent_id',
                'label' => trans('admin::menus.parent_id'),
                'lookup' => [
                    'dataSource' => MenusModel::get(['menu_name', 'id'])->toArray(),
                    'valueExpr' => 'id',
                    'displayExpr' => 'menu_name'
                ],
            ],
        ];
    }

    public function renderSearchForm()
    {
        $menu_type = Menus::getMenuTypes();
        return '<div class="menu-type mb-3">'.
            FormFacade::select('menu_type', $menu_type, request('type'), ['class' => 'custom-select', 'id' => 'menu_type'])
            .'</div>';
    }

    protected function getCreareUrl()
    {
        $menu_type = request('type');
        return route($this->getSectionCode().'.create', [$menu_type, 'ref' => $this->getId()]);
    }

    protected function getEditUrl($params)
    {
        $menu_type = request('type');
        $params = array_merge($params, [$menu_type]);
        ksort($params, SORT_NATURAL);
        return parent::getEditUrl($params);
    }

    protected function configureButtons()
    {
        parent::configureButtons();
        $this->addToolbarButton('sort-order', [
            'key' => 'sort-order',
            'name' => 'sort-order',
            'title' => trans('admin::common.btn_sort_order'),
            'label' => trans('admin::common.btn_sort_order'),
            'variant' => 'success',
            'size' => '',
            'position' => 3,
            'url' => function($item) {
                return route('menus.sort', request('type'));
            },
            'icon' => 'fa-sort-amount-asc',
            'visible' => function($item) {
                return true;
            }
        ]);
    }
}
