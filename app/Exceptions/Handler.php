<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }

/*
    public function render($request, Exception $exception)
    {
        if($this->isHttpException($exception)){
            switch ($exception->getStatusCode()) {

                case 404:
                return redirect()->route('404');
                break;

                case 405:
                return redirect()->route('404');
                break;

                case 500:
                return redirect()->route('500');
                break;
            }
        }

        return parent::render($request, $exception);
    }*/
}
