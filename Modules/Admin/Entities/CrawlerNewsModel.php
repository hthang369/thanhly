<?php

namespace Modules\Admin\Entities;

class CrawlerNewsModel extends AdminBaseModel
{
    protected $table = 'crawler_news';

    protected $fillable = [
        'crawler_link',
        'crawler_selector',
        'title_selector',
        'image_selector',
        'excerpt_selector',
        'date_selector',
        'link_selector',
        'content_selector',
        'crawler_page_from',
        'crawler_page_to',
        'crawler_name',
        'status'
    ];
}
