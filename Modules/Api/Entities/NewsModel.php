<?php

namespace Modules\Api\Entities;

class NewsModel extends NewsBaseModel
{
    protected $table = 'posts';

    protected $fillable = [
        'post_author',
        'post_title',
        'post_excerpt',
        'post_name',
        'post_date',
        'post_link',
        'post_content',
        'ob_title',
        'ob_desception',
        'ob_keyword',
        'post_type',
        'post_status'
    ];
}
