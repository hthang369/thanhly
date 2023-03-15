<?php
namespace Modules\Core\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Laka\Core\Enums\ActionStatus;
use Modules\Core\Enums\ActionHot;

class ActionStatusScope implements Scope
{
    protected $extendsions = ['WithoutStatus', 'WithInActive', 'WithIsHot'];

    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getQualifiedIsStatusColumn(), '=', ActionStatus::ACTIVE);
    }

    public function extend(Builder $builder)
    {
        foreach($this->extendsions as $method) {
            $this->{"add$method"}($builder);
        }
    }

    protected function addWithoutStatus(Builder $builder)
    {
        $builder->macro('withoutStatus', function (Builder $builder, $withoutStatus = true) {
            if ($withoutStatus) {
                return $builder->withoutGlobalScope($this);
            }

            return $builder;
        });
    }

    protected function addWithInActive(Builder $builder)
    {
        $model = $builder->getModel();
        $builder->macro('withInActive', function (Builder $query) use($model) {
            $query->withoutGlobalScope($this)->where($model->getQualifiedIsStatusColumn(), '=', ActionStatus::INACTIVE);

            return $query;
        });
    }

    protected function addWithIsHot(Builder $builder)
    {
        $builder->macro('withIsHot', function (Builder $builder) {
            $model = $builder->getModel();
            $builder->where($model->getQualifiedIsHotColumn(), '=', ActionHot::HOT);

            return $builder;
        });
    }
}