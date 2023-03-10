<?php

namespace Modules\Home\Repositories;

use Laka\Core\Repositories\CoreRepository;
use Modules\Admin\Enums\CategoryType;
use Modules\Core\Entities\Categories\CategoriesModel;

class CategoryRepository extends CoreRepository
{
    protected $modelClass = CategoriesModel::class;

    public function show($id, $columns = [])
    {
        $info = $this->findByField('category_link', $id, ['category_name', 'id', 'category_type'])->first();
        $method = str_is($info->category_type, CategoryType::PRODUCT) ? 'products' : 'posts';
        $info->setRelation('pagination_'.$method, $info->{$method}()->paginate(15));
        return $info;
    }
}
