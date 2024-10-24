<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
        // Manejo de errores de validación con respuesta JSON
        if ($e instanceof ValidationException) {
            if ($request->expectsJson()) {
                $errors = $e->errors();

                return response()->json([
                    'message' => reset($errors),
                    'errors' => $errors,
                ]);
            }
        }

        // Determinamos el código de estado según el tipo de error
        $statusCode = 500;  // Código por defecto para errores internos

        if ($e instanceof NotFoundHttpException) {
            $statusCode = 404;
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            $statusCode = 405;
        }

        // Renderizamos la vista alerta_error.blade.php con el código y el mensaje del error
        return response()->view('errors.alerta_error', [
            'code' => $statusCode,
            'message' => $e->getMessage(),  // Si quieres un mensaje personalizado, puedes modificar esto
        ], $statusCode);
    }

}
