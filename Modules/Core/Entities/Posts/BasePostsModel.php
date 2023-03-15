<?php

namespace Modules\Core\Entities\Posts;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\CoreModel;
use Modules\Core\Enums\PostType;
use Modules\Core\Traits\ActionScopeTrait;

abstract class BasePostsModel extends CoreModel
{
    use ActionScopeTrait;
    
    protected $table = 'posts';

    protected $fillable = [
        'author_id',
        'post_title',
        'post_excerpt',
        'post_date',
        'post_link',
        'post_content',
        'post_image',
        'ob_title',
        'ob_desception',
        'ob_keyword',
        'post_type',
        'post_status',
        'post_ishot'
    ];

    protected $slugColumn = [
        'post_link' => 'post_title'
    ];

    protected $seoMetaColumn = [
        'ob_title' => 'post_title'
    ];

    protected static function booted()
    {
        static::addGlobalScope('doc_type', function(Builder $builder) {
            $builder->whereDocType('post_type', static::$type ?? PostType::PAGE);
        });
    }
}
