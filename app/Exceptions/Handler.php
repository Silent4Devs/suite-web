<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if (app()->environment('production') && app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }

    public function render($request, Throwable $e)
    {
        // 1. Errores menores que no afectan el flujo crítico de TABANTAJ
        // Los dejamos a Laravel para su manejo estándar.
        if ($e instanceof ValidationException ||
            $e instanceof AuthenticationException ||
            $e instanceof AuthorizationException) {
            return parent::render($request, $e);
        }

        // Errores de rutas comunes (404) o métodos no permitidos (405):
        // También que Laravel maneje estos errores normalmente,
        // ya que no son críticos para la funcionalidad del sistema.
        if ($e instanceof NotFoundHttpException) {
            return parent::render($request, $e);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return parent::render($request, $e);
        }

        return response()->view('errors.alerta_error', [
            'code' => 500,
            'message' => $e->getMessage(),  // Pasamos el mensaje del error
        ], 500);
    }

}
