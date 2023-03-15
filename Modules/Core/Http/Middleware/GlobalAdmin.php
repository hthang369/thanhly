<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Pagination\LengthAwarePaginator;

class GlobalAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $valid_passwords = array (env('GLOBAL_USER') => env('GLOBAL_PW'));
        $valid_users = array_keys($valid_passwords);

        $user = $_SERVER['PHP_AUTH_USER'] ?? '';
        $pass = $_SERVER['PHP_AUTH_PW'] ?? '';
        $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

        if (!$validated) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            die ("Not authorized");
        }

        // set default bootstrap view for log viewer because default laravel is taiwincss
        LengthAwarePaginator::useBootstrap();

        return $next($request);
    }
}
?>
