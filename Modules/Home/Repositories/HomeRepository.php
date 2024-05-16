<?php

namespace Modules\Home\Repositories;

use Exception;
use Modules\Admin\Enums\CategoryType;
use Modules\Admin\Repositories\Contacts\ContactsRepository;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\Menus\MenusModel;
use Modules\Core\Entities\Pages\PagesModel;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Core\Facades\PromotionFormular;
use Modules\Core\Repositories\HomeCoreRepository;
use Modules\Home\Entities\HomeModel;
use Modules\Home\Entities\ServiceCategoryModel;
use Modules\Home\Jobs\SendMail;

class HomeRepository extends HomeCoreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PagesModel::class;
    }

    public function showPage($id, $viewName)
    {
        return $this->getDataHome($id);
    }

    public function sendMail($attributes)
    {
        try {
            $data = resolve(ContactsRepository::class)->create($attributes);
            SendMail::dispatch($attributes);
            return $data;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getDataHome($id)
    {
        $data = $this->find($id);
        $dataCategory = ServiceCategoryModel::withIsHot()->defaultOrder()->with(['posts' => function($query) {
            return $query->limit(8);
        }])->get();
        $dataProduct = ProductsModel::with(['currency', 'promotions'])->limit(8)->get()->transform(function($item) {
            return PromotionFormular::calcalulator($item);
        });
        // dd($dataCategory);
        return [
            'info' => $data,
            'list_categories' => $dataCategory,
            'list_products' => $dataProduct
        ];
    }
}
