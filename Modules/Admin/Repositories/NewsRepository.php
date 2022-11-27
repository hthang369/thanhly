<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Entities\NewsModel;
use Modules\Admin\Forms\NewsForm;
use Modules\Admin\Grids\NewsGrid;
use Laka\Core\Support\FileManagementService;

class NewsRepository extends BasePostsRepository
{
    use NewsCriteria;
    protected $type = 'news';

    protected $presenterClass = NewsGrid::class;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NewsModel::class;
    }

    /**
     * Specify Form class name
     *
     * @return string
     */
    public function form()
    {
        return NewsForm::class;
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
}
