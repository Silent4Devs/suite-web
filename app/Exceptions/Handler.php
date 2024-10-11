<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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
        if ($exception instanceof MethodNotAllowedHttpException) {
            // Puedes devolver una vista personalizada o un mensaje de error
            return response()->json(['error' => 'Método HTTP no permitido para esta ruta'], 405);
        }
        
        if ($e instanceof ValidationException) {
            if ($request->expectsJson()) {
                $errors = $e->errors();

                return response()->json([
                    'message' => reset($errors),
                    'errors' => $errors,
                ]);
            }
        }

        return parent::render($request, $e);
    }
}
