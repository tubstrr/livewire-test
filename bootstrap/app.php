<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->group('web', [
            \Silber\PageCache\Middleware\CacheResponse::class
        ]);
        $middleware->alias([
            'page-cache' => \Silber\PageCache\Middleware\CacheResponse::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
