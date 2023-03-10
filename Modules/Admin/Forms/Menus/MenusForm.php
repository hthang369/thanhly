<?php

namespace Modules\Admin\Forms\Menus;

use Modules\Admin\Facades\Menus;
use Laka\Core\Forms\Field;
use Modules\Core\Entities\Menus\MenusModel;
use Modules\Core\Forms\CoreForm;

class MenusForm extends CoreForm
{
    protected $groupLangKey = 'menus';

    public function buildForm()
    {
        $menu_type = request('type');
        $this
            ->add('menu_name', Field::TEXT)
            ->add('menu_link', Field::TEXT)
            ->add('parent_id', Field::SELECT, [
                'choices' => MenusModel::where('menu_type', $menu_type)->pluck('menu_name', 'id')->toArray(),
                'selected' => data_get($this->getModel(), 'parent_id'),
                'empty_value' => '=== Select menu ==='
            ])
            ->add('partial_table', 'page_or_link', [
                'label' => 'Type',
                'list_type' => Menus::getDataSourceTabPartialTypes(),
                'selected' => head(array_keys(Menus::getPartialTypes())),
                'models' => config('admin.partial_table'),
                'type_selected' => head(array_keys(Menus::getPartialTypes()))
            ])
            ->add('menu_type', Field::HIDDEN, [
                'value' => $menu_type
            ]);
    }
}
