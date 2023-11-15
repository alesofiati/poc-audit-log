<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->notFound();

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @return void
     */
    private function notFound(): void
    {
        $this->renderable(function(NotFoundHttpException $exception, Request $request) {
            if ($request->isJson()) {
                return response()->json([
                    'message' => 'Recurso não encontrado'
                ], 404);
            }
            return view('errors.404');
        });
    }

}
