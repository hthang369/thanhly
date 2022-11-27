<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Cookie;
class VerifyCsrfToken extends Middleware
{
    const HTTP_ONLY = true;
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Add the CSRF token to the response cookies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');

        if ($response instanceof Responsable) {
            $response = $response->toResponse($request);
        }

        $response->headers->setCookie(
            new Cookie(
                'XSRF-TOKEN', $request->session()->token(), $this->availableAt(60 * $config['lifetime']),
                $config['path'], $config['domain'], $config['secure'], self::HTTP_ONLY, false, $config['same_site'] ?? null
            )
        );

        return $response;
    }
}
