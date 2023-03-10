<?php

namespace Modules\Home\Repositories;

use Laka\Core\Repositories\BaseRepository;
use Modules\Admin\Enums\CategoryType;
use Modules\Admin\Repositories\Contacts\ContactsRepository;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\Menus\MenusModel;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Home\Entities\HomeModel;
use Modules\Home\Entities\ServiceCategoryModel;

class HomeRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HomeModel::class;
    }

    public function show($id, $columns = [])
    {
        $menu = MenusModel::where('menu_link', $id)->first();
        $results = $menu;
        switch(data_get($menu, 'partial_table')) {
            case 'page':
                $data = PostsModel::find(data_get($menu, 'partial_id'));
                $data['header_title'] = $data->post_title;
                $results = $data;
                break;
            case 'category':
                $results = CategoriesModel::find(data_get($menu, 'partial_id'));
                $results['header_title'] = $results->category_name;
                $method = str_is($results->category_type, CategoryType::PRODUCT) ? 'products' : 'posts';
                $results->setRelation('pagination_'.$method, $results->{$method}()->paginate(15));
                $results['children'] = CategoriesModel::whereIsAfter(data_get($menu, 'partial_id'))->defaultOrder()->with($method)->get()->toTree();
                break;
            default:
                $results = $this->getDataHome();
                break;
        }
        return [
            'view_name' => data_get($menu, 'menu_view'),
            'data' => $results
        ];
    }

    public function showCategory($id)
    {
        
    }

    public function sendMail($attributes)
    {
        return resolve(ContactsRepository::class)->create($attributes);
    }

    public function getDataHome()
    {
        $data = ServiceCategoryModel::whereIsHot('category_ishot')->defaultOrder()->with('home_posts')->get();
        $dataPost = PostsModel::whereIsHot('post_ishot')->whereIsPost()->whereActive('post_status')->limit(4)->get();
        $dataProduct = ProductsModel::whereIsHot('ishot')->whereActive('status')->with('images')->limit(12)->get();
        
        return [
            'list_post' => $dataPost,
            'list_categories' => $data,
            'list_products' => $dataProduct
        ];
    }
}
