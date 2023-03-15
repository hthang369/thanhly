<?php

namespace Modules\WebDesign\Repositories;

use Laka\Core\Repositories\BaseRepository;
use Modules\Admin\Enums\CategoryType;
use Modules\Admin\Repositories\Contacts\ContactsRepository;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\Menus\MenusModel;
use Modules\Core\Entities\News\NewsModel;
use Modules\Core\Entities\Pages\PagesModel;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Core\Entities\Products\ProductsModel;
use Modules\Home\Facades\Portfolio;
use Modules\WebDesign\Entities\WebDesignModel;

class WebDesignRepository extends BaseRepository
{
    protected $modelClass = WebDesignModel::class;

    public function show($id, $columns = [])
    {
        $menu = MenusModel::where('menu_link', $id)->first();
        if (!blank($menu)) {
            $results = $menu;
            $menuView = data_get($menu, 'menu_view');
            $docType = data_get($menu, 'partial_table');
            switch($docType) {
                case 'page':
                    $results = PagesModel::find(data_get($menu, 'partial_id'));
                    break;
                case 'category':
                case 'news':
                    $results = CategoriesModel::find(data_get($menu, 'partial_id'));
                    if ($results) {
                        $method = str_is($results->category_type, CategoryType::PRODUCT) ? 'products' : (str_is($results->category_type, 'news') ? 'news' : 'posts');
                        $relations = str_is($results->category_type, CategoryType::PRODUCT) ? ['category_id', 'promotions', 'uom'] : ['category_id'];
                        $results->setRelation('pagination_'.$method, $results->{$method}()->with($relations)->paginate(15));
                        $results['children'] = CategoriesModel::whereIsAfter(data_get($menu, 'partial_id'))->defaultOrder()->with('posts')->get()->toTree();
                    }
                    break;
                default:
                    $results = $this->getDataHome();
                    break;
            }
        } else {
            $results = $this->findPage($id);
            $menuView = 'show';
        }
        return [
            'view_name' => $menuView,
            'data' => $results
        ];
    }

    public function sendMail($attributes)
    {
        return resolve(ContactsRepository::class)->create($attributes);
    }

    public function getDataHome()
    {
        $dataPost = ProductsModel::withIsHot()->with(['images', 'promotions'])->limit(16)->get();
        $list_post = Portfolio::convertProduct($dataPost);
        $categoryInfo = CategoriesModel::with('posts')->withIsHot()->first();
        $list_page = PagesModel::withIsHot()->first();
        
        return compact('list_post', 'categoryInfo', 'list_page');
    }

    public function findPage($id)
    {
        return PagesModel::where('post_link', $id)->first();
    }

    public function findPost($id)
    {
        $info = PostsModel::where('post_link', $id)->first();
        if (blank($info)) {
            $info = NewsModel::where('post_link', $id)->first();
        }
        return $info;
    }

    public function findProduct($id)
    {
        return ProductsModel::where('link', $id)->first();
    }

    public function findPostCategory($id)
    {
        $results = CategoriesModel::where('category_link', $id)->first();
        $listPost = $results->posts()->paginate(15);
        $results->setRelation('pagination_posts', $listPost);
        return $results;
    }
}
