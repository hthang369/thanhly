<?php

namespace Modules\Admin\Entities;

class CrawlerPostNewsModel extends AdminBaseModel
{
    protected $table = 'crawler_posts_news';

    protected $fillable = [
        'crawler_id',
        'post_id'
    ];
}
