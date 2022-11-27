<?php

namespace Modules\Home\Repositories;

use Modules\Admin\Entities\CategoriesModel;
use Modules\Admin\Entities\MenusModel;
use Modules\Admin\Entities\PostsModel;
use Modules\Admin\Repositories\ContactsRepository;
use Modules\Admin\Repositories\PostsRepository;
use Modules\Home\Entities\HomeModel;
use Laka\Core\Repositories\BaseRepository;

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
                $results = $data->toArray();
                break;
            case 'category':
                $data = CategoriesModel::find(data_get($menu, 'partial_id'));
                $results = $data->toArray();
                $results['data_list'] = $this->getProductsData($data->id, $data->category_type);
                break;
            case 'news':
                $data = CategoriesModel::find(data_get($menu, 'partial_id'));
                $results = $data->toArray();
                $results['post_list'] = resolve(PostsRepository::class)->getAllDataByCategory($data->id, 'news')->toArray();
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
}
