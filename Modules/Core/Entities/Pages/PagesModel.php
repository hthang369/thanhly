<?php

namespace Modules\Core\Entities\Pages;

use Modules\Core\Entities\Posts\BasePostsModel;
use Modules\Core\Enums\PostType;

class PagesModel extends BasePostsModel
{
    protected static $type = PostType::PAGE;
}
