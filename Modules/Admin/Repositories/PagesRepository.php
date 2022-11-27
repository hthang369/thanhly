<?php

namespace Modules\Admin\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\PostImagesModel;
use Modules\Admin\Entities\PostsModel;
use Modules\Admin\Forms\PagesForm;
use Modules\Admin\Grids\PagesGrid;
use Laka\Core\Support\FileManagementService;

class PagesRepository extends BasePostsRepository
{
    use PagesCriteria;

    protected $type = 'page';

    protected $imageColumnName = 'post_image';

    protected $presenterClass = PagesGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostsModel::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        return PagesForm::class;
    }

    /**
     * Specify Service class name
     *
     * @return string
     */
    public function service()
    {
        return FileManagementService::class;
    }

    public function create(array $attributes)
    {
        $attributes['post_type'] = $this->type;
        $attributes['post_date'] = now();
        if (blank($attributes['post_link']))
            $attributes['post_link'] = str_slug($attributes['post_title']);
        $attributes['post_status'] = 1;
        $attributes['author_id'] = user_get('id');

        return parent::create($attributes);
    }

    public function update(array $attributes, $id)
    {
        $attributes['author_id'] = user_get('id');
        if (blank($attributes['post_link']))
            $attributes['post_link'] = str_slug($attributes['post_title']);

        return parent::update($attributes, $id);
    }
}
