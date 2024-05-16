<?php

namespace Modules\Home\Entities\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ServiceScope implements Scope
{
    protected $type = 'dich-vu';

    public function apply(Builder $builder, Model $model)
    {
        // $builder->whereExists(function($query) use($model) {
        //     $query->selectRaw(1)
        //         ->from($model->getTable(), 'c')
        //         ->where('c.category_link', $this->type)
        //         ->whereColumn($model->qualifyColumn('parent_id'), '=', 'c.id');
        // });
        $builder->where('category_link', $this->type);
    }
}
