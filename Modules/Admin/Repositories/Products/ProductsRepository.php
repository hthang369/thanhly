<?php

namespace Modules\Admin\Repositories\Products;

use Closure;
use Laka\Core\Support\FileManagementService;
use Modules\Admin\Enums\AttributesGroup;
use Modules\Admin\Forms\Products\AttributesForm;
use Modules\Admin\Forms\Products\ImagesForm;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Admin\Forms\Products\ProductsForm;
use Modules\Admin\Grids\Products\ProductsGrid;
use Modules\Admin\Repositories\AdminBaseRepository;
use Modules\Core\Entities\Products\ProductAttributesModel;
use Modules\Core\Entities\Products\ProductCategoriesModel;
use Modules\Core\Entities\Products\ProductPromotionsModel;
use Modules\Core\Entities\Products\ProductVariantsModel;

class ProductsRepository extends AdminBaseRepository
{
    protected $presenterClass = ProductsGrid::class;

    protected $modelClass = ProductsModel::class;

    protected $formClass = ProductsForm::class;

    protected $serviceClass = FileManagementService::class;

    protected $withs = ['categories', 'brand'];

    protected $imageColumnName = 'image';

    public function form()
    {
        return [
            $this->formClass,
            AttributesForm::class,
            ImagesForm::class
        ];
    }

    public function show($id, $columns = [], $with = [])
    {
        return parent::show($id, $columns, ['attributes']);
    }

    protected function upsertData(array $attributes, $id = null)
    {
        $listCategories = array_pull($attributes, 'categories');
        $listPromotions = array_pull($attributes, 'promotions');
        $listImages = array_pull($attributes, 'image_list');
        array_forget($attributes, ['_method', '_token']);
        $listAttrs = [
            AttributesGroup::GROUP_ATTRIBUTE => array_filter(array_except($attributes, $this->model->getFillable())),
            AttributesGroup::GROUP_IMAGE => ['other_images' => $listImages],
        ];
        
        return parent::upsert($attributes, $id, function($result) use($listCategories, $listAttrs, $listPromotions, $listVariants) {
            // $this->upsertForenignCategories(ProductCategoriesModel::class, $listCategories, $result->categories, $result->id);
            // $this->upsertForenignColumn(ProductPromotionsModel::class, $listPromotions, $result->promotions, $result->id, 'promotion_id');
            $this->upsertAttributes(ProductAttributesModel::class, $listAttrs, $result->attributes, $result->id);
        });
    }

    public function create(array $attributes)
    {
        $attributes['author_id'] = user_get('id');
        return $this->upsertData($attributes);
    }

    public function update(array $attributes, $id)
    {
        return $this->upsertData($attributes, $id);
    }
}
