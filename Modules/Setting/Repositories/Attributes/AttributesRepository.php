<?php

namespace Modules\Setting\Repositories\Attributes;

use Laka\Core\Traits\Scopes\DomainScope;
use Modules\Admin\Enums\AttributesGroup;
use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Setting\Entities\Attributes\AttributesModel;
use Modules\Setting\Forms\Attributes\AttributesForm;
use Modules\Setting\Grids\Attributes\AttributesGrid;

class AttributesRepository extends AdminBaseRepository
{
    protected $presenterClass = AttributesGrid::class;

    protected $modelClass = AttributesModel::class;

    protected $formClass = AttributesForm::class;

    public function create(array $attributes)
    {
        if (blank($attributes['language']))
            $attributes['language'] = 'setting::attributes.'.$attributes['key'];

        return parent::createNestedTree($attributes);
    }

    public function update(array $attributes, $id)
    {
        if (blank($attributes['language']))
            $attributes['language'] = 'setting::attributes.'.$attributes['key'];

        return parent::updateNestedTree($attributes, $id);
    }

    protected function getSortableMenus($dataTree, $callback = null)
    {
        return parent::getSortableMenus($dataTree, function($item) {
            $item->title = trans($item->language);
            return ['title' => $item->title];
        });
    }

    protected function getDataAttributes($type)
    {
        return $this->model->with('children')->defaultOrder()->get()->toTree()->keyBy('key')->get($type);
    }

    public function getProductAttributes()
    {
        return $this->getDataAttributes(AttributesGroup::GROUP_ATTRIBUTE)->children
            ->flatMap(function($item) {
                return $item->children;
            });
    }

    public function getImageAttributes()
    {
        return $this->getDataAttributes(AttributesGroup::GROUP_IMAGE);
    }

    public function getPreviewAttributes()
    {
        return $this->getDataAttributes(AttributesGroup::GROUP_PREVIEW);
    }

    public function getSelectedNestedList($columns = [], $callback = null)
    {
        return parent::getSelectedNestedList([], function($item) {
            $item->name = trans($item->language);
            return $item;
        });
    }
}
