<?php

namespace Modules\Admin\Repositories\News;

use Laka\Core\Support\FileManagementService;
use Modules\Core\Entities\News\NewsModel;
use Modules\Admin\Forms\News\NewsForm;
use Modules\Admin\Grids\News\NewsGrid;
use Modules\Admin\Repositories\Posts\BasePostsRepository;

class NewsRepository extends BasePostsRepository
{
    use NewsCriteria;
    protected $type = 'news';

    protected $presenterClass = NewsGrid::class;

    protected $modelClass = NewsModel::class;

    protected $formClass = NewsForm::class;

    protected $serviceClass = FileManagementService::class;

}
