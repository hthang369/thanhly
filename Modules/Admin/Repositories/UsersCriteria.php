<?php

namespace Modules\Admin\Repositories;

class UsersCriteria
{
    protected function fullnameFilter($value)
    {
        return $this->builder->where('name', 'like', "%$value%");
    }

    protected function agingSort($direction)
    {
        return $this->builder->orderBy('age', $direction);
    }
}
