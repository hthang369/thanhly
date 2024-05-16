<?php

namespace Modules\Core\Repositories;

use Laka\Core\Repositories\CoreRepository as BaseCoreRepository;
use Modules\Core\Entities\Menus\MenusModel;

abstract class HomeCoreRepository extends BaseCoreRepository
{
    public function show($id, $columns = [], $with = [])
    {
        $menu = MenusModel::where('menu_link', $id)->first();
        $menuView = data_get($menu, 'menu_view');
        $docType = ucfirst(data_get($menu, 'partial_table', 'internal'));
        $docId = data_get($menu, 'partial_id');
        $method = "show{$docType}";
        return $this->$method($docId ?? $id, $menuView);
    }

    protected function findDocument($model, $column, $id, $relationTable, $relationKey, $orderBy, $with = [], $popularColumns = ['*'], $limit = 8)
    {
        $withRelation = array_merge(['category_id'], $with);
        $info = $model->where($column, $id)->with($withRelation)->first();
        if (blank($info)) return [null, null];
        $lstCategories = $info->category_id->pluck('id')->toArray();
        $listPopular = $model->whereKeyNot($info->id)
            ->with($with)
            ->select($popularColumns)
            ->whereExists(function($query) use($lstCategories, $relationTable, $relationKey, $model) {
                $query->selectRaw(1)
                    ->from($relationTable)
                    ->whereIn('category_id', $lstCategories)
                    ->whereColumn($model->getQualifiedKeyName(), '=', "{$relationTable}.{$relationKey}")
                    ->groupBy("{$relationTable}.{$relationKey}")
                    ->havingRaw("COUNT({$relationTable}.{$relationKey}) = 2");
            })
            ->orderBy($orderBy, 'desc')
            ->limit($limit)
            ->get();

        return [$info, $listPopular];
    }
}
