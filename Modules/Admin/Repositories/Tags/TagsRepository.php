<?php

namespace Modules\Admin\Repositories\Tags;

use Laka\Core\Repositories\CoreRepository;
use Modules\Core\Entities\Tags\TagsModel;
use Modules\Admin\Forms\Tags\TagsForm;
use Modules\Admin\Grids\Tags\TagsGrid;

class TagsRepository extends CoreRepository
{
    protected $presenterClass = TagsGrid::class;

    protected $modelClass = TagsModel::class;

    protected $formClass = TagsForm::class;
}
