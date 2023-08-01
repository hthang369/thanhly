<?php

namespace Modules\Core\Repositories;

use Closure;
use Illuminate\Support\Facades\DB;
use Laka\Core\Facades\Common;
use Laka\Core\Repositories\CoreRepository as BaseCoreRepository;
use Laka\Core\Plugins\Nestedset\NodeTrait;
use Modules\Core\Traits\Scopes\ActionStatusScope;

abstract class CoreRepository extends BaseCoreRepository
{
    public function getDataSort($id = null)
    {
        $builder = $this->model;
        $dataTree = $builder->defaultDataSortTree($id)->get($builder->getDataSortColumns())->toTree();
        return $this->getSortableMenus($dataTree);
    }

    protected function getSortableMenus($dataTree, $callback = null)
    {
        return Common::renderMenus($dataTree, 'nestedSortable', 'nested_sortable_bt4', false, function($item) use($callback) {
            $data = [
                'id' => 'item_'.data_get($item, 'id')
            ];
            if (!blank($callback) && is_callable($callback)) {
                $data = array_merge($data, with($item, $callback));
            }
            return $data;
        });
    }

    public function updateSortNestedTree(array $attributes, Closure $callback = null)
    {
        return DB::transaction(function() use($attributes, $callback) {
            $parentColumn = $this->model->getParentIdName();
            $lftColumn = $this->model->getLftName();
            $rgtColumn = $this->model->getRgtName();
            foreach ($attributes as $item) {
                if (array_has($item, 'item_id') && is_null($item['item_id'])) continue;
                $data = [
                    $parentColumn => $item['parent_id'],
                    $lftColumn    => $item['left'] - 1,
                    $rgtColumn    => $item['right'] - 1,
                ];
                if (!blank($callback) && is_callable($callback)) {
                    $data = array_merge($data, with($item, $callback));
                }
                parent::update($data, $item['id']);
            }
            return true;
        });
    }

    public function insertNestedNode($model, $parent_id)
    {
        if (is_null($parent_id)) {
            $model->saveAsRoot();
        } else {
            $parentNode = $this->find($parent_id);

            $parentNode->appendNode($model);
        }
        return $model;
    }

    public function createNestedTree(array $attributes)
    {
        $model = $this->model->newInstance($attributes);

        $parent_id = data_get($attributes, $this->model->getParentIdName(), null);

        $this->insertNestedNode($model, $parent_id);

        $this->resetModel();

        return $this->parserResult($model);
    }

    public function updateNestedTree(array $attributes, $id)
    {
        $this->applyScope();

        $model = $this->model->findOrFail($id);

        $parent_id = data_get($attributes, $this->model->getParentIdName(), null);

        $model->fill($attributes);

        if ($model->getParentId() !== intval($parent_id)) {
            $this->insertNestedNode($model, $parent_id);
        } else {
            $model->save();
        }

        $this->resetModel();

        return $this->parserResult($model);
    }

    protected function paginateData($data = null, string $method = "paginate", int $limit = null, array $columns = [])
    {
        return call_user_func([$this->model->with($this->withs)->withoutGlobalScope(ActionStatusScope::class), $method], ...array_filter([$data, $limit, $columns]));
    }

    public function allDataGrid()
    {
        if (array_search(NodeTrait::class, class_uses_recursive($this->model))) {
            return $this->allNestedDataGrid();
        }
        return parent::allDataGrid();
    }

    public function paginateNestedTree($limit = null, $columns = [], $method = "paginateNestedTree")
    {
        $this->applyScope();
        $this->applyCriteria();

        $columns = $this->getColumns($columns);

        $limit = is_null($limit) ? $this->getLimitForPagination() : $limit;
        $results = $this->model->withoutGlobalScope(ActionStatusScope::class)->{$method}($limit, $columns);
        $results->appends(request()->except($this->except));
        $this->resetQuery();

        return $this->parserResult($results);
    }

    public function allNestedDataGrid()
    {
        if ($this->presenterGrid) {
            $data = $this->paginateNestedTree();
            return [$this->presenterGrid, $data];
        }
        return [];
    }

    public function getSelectedNestedList($columns = [], $callback = null)
    {
        $builder = $this->model->defaultDepthNestedTree();
        if (count($columns) > 0) $builder->addSelect($columns);
        return $this->parseSelectedNestedList($builder->get(), $callback);
    }

    public function parseSelectedNestedList($results, $callback = null)
    {
        return $results->mapToDictionary(function($item, $key) use($callback) {
            $info = $item;
            if (!is_null($callback) && is_callable($callback)) {
                $info = with($item, $callback);
            }
            
            return [data_get($info, 'id') => str_repeat('-- ', data_get($info, 'depth')).data_get($info, 'name')];
        })->map(function($item) {
            return head($item);
        })->toArray();
    }

    public function deleteByField($column, $value)
    {
        return $this->deleteWhere([$column => $value]);
    }
}
