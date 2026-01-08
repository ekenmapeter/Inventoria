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
<<<<<<< HEAD
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
=======
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'moderator' => \App\Http\Middleware\ModeratorMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
        //
    })->create();
