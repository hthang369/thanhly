<?php

namespace Modules\Admin\Repositories\Pages;

use Laka\Core\Support\FileManagementService;
use Modules\Core\Entities\Pages\PagesModel;
use Modules\Admin\Forms\Pages\PagesForm;
use Modules\Admin\Grids\Pages\PagesGrid;
use Modules\Admin\Repositories\Posts\BasePostsRepository;

class PagesRepository extends BasePostsRepository
{
    use PagesCriteria;

    protected $type = 'page';

    protected $imageColumnName = 'post_image';

    protected $presenterClass = PagesGrid::class;

    protected $modelClass = PagesModel::class;

    protected $formClass = PagesForm::class;

    protected $serviceClass = FileManagementService::class;

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
