<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast;
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
        $this->renderable(\ProtoneMedia\Splade\SpladeCore::exceptionHandler($this, function (Throwable $e, Request $request) {
            if ($e instanceof FusionException) {
                Toast::warning($e->getMessage())->autoDismiss(5);
                return Redirect::back()->withErrors([
                    'success' => false
                ]);
            }
        }));

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
