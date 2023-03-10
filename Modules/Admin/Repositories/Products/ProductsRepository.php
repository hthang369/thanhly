<?php

namespace Modules\Admin\Repositories\Products;

use Laka\Core\Enums\ActionStatus;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Admin\Forms\Products\ProductsForm;
use Modules\Admin\Grids\Products\ProductsGrid;
use Modules\Admin\Repositories\AdminBaseRepository;

class ProductsRepository extends AdminBaseRepository
{
    protected $presenterClass = ProductsGrid::class;

    protected $modelClass = ProductsModel::class;

    protected $formClass = ProductsForm::class;

    protected function upsertWithCategories(array $attributes, $id = null)
    {
        $listCategories = $attributes['category_id'];
        return parent::upsert($attributes, $id, function($result) use($listCategories) {
            $this->upsertForenignCategories(ProductCategoriesRepository::class, $listCategories, $result->id);
        });
    }

    public function create(array $attributes)
    {
        $method = array_has($attributes, 'category_id') ? 'upsertWithCategories' : 'upsert';
        $attributes['status'] = ActionStatus::ACTIVE;
        $attributes['author_id'] = user_get('id');
        return $this->$method($attributes);
    }

    public function update(array $attributes, $id)
    {
        $method = array_has($attributes, 'category_id') ? 'upsertWithCategories' : 'upsert';
        return $this->$method($attributes, $id);
    }
}
