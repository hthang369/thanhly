<?php

namespace Modules\Home\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessHomeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (class_exists(get_class($request->route()->getController()))) {
            return $next($request);
        }
    }
}
