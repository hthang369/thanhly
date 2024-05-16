<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
use Laka\Core\Facades\Common;
use Laka\Core\Http\Response\WebResponse;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    private $menuRepo;


    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response
     *
     * @throws Throwable
     */

    public function render($request, Throwable $e)
    {
        // Set default value for message,statusCode,menuLeft
        $message = "";
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        switch(get_class($e)) {
            case ValidatorException::class:
                $message = $e->getMessageBag();
                $code = Response::HTTP_NOT_ACCEPTABLE;
                return $this->response($code, $message, Route::has(Common::getSectionCode() . '.index'));
            break;
            case NotFoundHttpException::class:
                $$code = $e->getStatusCode();
                $message = $e->getMessage();
                return $this->response($code, $message);
            break;
            case FatalError::class:
            case ConnectionException::class:
            case InvalidArgumentException::class:
            case ModelNotFoundException::class:
                $message = $e->getMessage();
                return $this->response($code, $message);
            break;
            case AuthorizationException::class:
                $code = Response::HTTP_UNAUTHORIZED;
                $message = $e->getMessage();
                return Auth::check()
                    ? $this->response($code, $message)
                    : parent::render($request, $e);
            break;
            case TokenMismatchException::class:
                if (!Auth::check()) {
                    return WebResponse::exception(route('login'));
                }
            break;
            case HttpException::class:
                return $this->response($e->getStatusCode(), $e->getMessage());
            break;
        }
        return parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->shouldReturnJson($request, $exception)
                    ? response()->json([
                        'message' => $exception->getMessage(),
                        'redirect' => $exception->redirectTo() ?? route('login', [], false)], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    protected function shouldReturnJson($request, Throwable $e)
    {
        return $request->expectsJson() || $request->ajax();
    }
}
