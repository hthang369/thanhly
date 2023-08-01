<?php

namespace Modules\Core\Entities\Posts;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\CoreModel;
use Modules\Core\Enums\PostType;
use Modules\Core\Traits\ActionScopeTrait;
use Modules\Core\Traits\SeoMetaTrait;

abstract class BasePostsModel extends CoreModel
{
    use ActionScopeTrait, SeoMetaTrait;
    
    protected $table = 'posts';

    protected $fillable = [
        'author_id',
        'post_title',
        'post_excerpt',
        'post_date',
        'post_link',
        'post_content',
        'post_image',
        'post_type'
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
