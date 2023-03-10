<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;

class ValidateFileSize extends ValidatePostSize
{
    private $type;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->type = $request->type;
        return parent::handle($request, $next);
    }

    /**
     * Determine the server 'post_max_size' as bytes.
     *
     * @return int
     */
    protected function getPostMaxSize()
    {
        $max_size = ini_get('post_max_size');
        switch($this->type) {
            case 'images':
                $max_size = env('IMAGES_SIZE', ini_get('post_max_size'));
            break;
            case 'media':
                $max_size = env('MEDIA_SIZE', ini_get('post_max_size'));
            break;
            default:
                $max_size = env('FILES_SIZE', ini_get('post_max_size'));
            break;
        }

        if (is_numeric($postMaxSize = $max_size)) {
            return (int) $postMaxSize;
        }

        $metric = strtoupper(substr($postMaxSize, -1));
        $postMaxSize = (int) $postMaxSize;
        switch ($metric) {
            case 'K':
                return $postMaxSize * 1024;
            case 'M':
                return $postMaxSize * 1048576;
            case 'G':
                return $postMaxSize * 1073741824;
            default:
                return $postMaxSize;
        }
    }
}
