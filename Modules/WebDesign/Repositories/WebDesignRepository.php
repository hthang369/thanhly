<?php

namespace Modules\WebDesign\Repositories;

use Laka\Core\Repositories\BaseRepository;
use Modules\Admin\Enums\CategoryType;
use Modules\Admin\Repositories\Contacts\ContactsRepository;
use Modules\Core\Entities\Categories\CategoriesModel;
use Modules\Core\Entities\Menus\MenusModel;
use Modules\Core\Entities\Posts\PostsModel;
use Modules\Home\Facades\Portfolio;
use Modules\WebDesign\Entities\WebDesignModel;

class WebDesignRepository extends BaseRepository
{
    protected $modelClass = WebDesignModel::class;

    public function show($id, $columns = [])
    {
        $menu = MenusModel::where('menu_link', $id)->first();
        $results = $menu;
        switch(data_get($menu, 'partial_table')) {
            case 'page':
                $results = PostsModel::find(data_get($menu, 'partial_id'));
                break;
            case 'category':
            case 'news':
                $results = CategoriesModel::find(data_get($menu, 'partial_id'));
                if ($results) {
                    $method = str_is($results->category_type, CategoryType::PRODUCT) ? 'products' : 'posts';
                    $relations = str_is($results->category_type, CategoryType::PRODUCT) ? ['category_id', 'promotions', 'uom'] : ['category_id'];
                    $results->setRelation('pagination_'.$method, $results->{$method}()->with($relations)->paginate(15));
                    $results['children'] = CategoriesModel::whereIsAfter(data_get($menu, 'partial_id'))->defaultOrder()->with('posts')->get()->toTree();
                }
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

    public function sendMail($attributes)
    {
        return resolve(ContactsRepository::class)->create($attributes);
    }

    public function getDataHome()
    {
        $dataPost = PostsModel::whereIsHot('post_ishot')->whereIsPost()->whereActive('post_status')->limit(16)->get();
        $list_post = Portfolio::convert($dataPost);
        
        return compact('list_post');
    }

    public function findPost($id)
    {
        return PostsModel::where('post_link', $id)->first();
    }

    public function findPostCategory($id)
    {
        $results = CategoriesModel::where('category_link', $id)->first();
        $listPost = $results->posts()->paginate(15);
        $results->setRelation('pagination_posts', $listPost);
        return $results;
    }
}
