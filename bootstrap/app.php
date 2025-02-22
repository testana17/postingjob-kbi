<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use Laravel\Sanctum\Http\Middleware\CheckAbilities;
// use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
// use App\Http\Middleware\JwtMiddleware;
// use App\Http\Middleware\RoleMiddleware;
// use App\Http\Middleware\EnsureUserIsCompany;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(JwtMiddleware::class);
        // $middleware->append(RoleMiddleware::class);
        // $middleware->appendToGroup('api', EnsureUserIsCompany::class);
    })
    // ->withMiddleware(function (Middleware $middleware) {
    //     $middleware->alias([
    //         'abilities' => CheckAbilities::class,
    //         'ability' => CheckForAnyAbility::class,
    //     ]);
    // })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    
//saat login api, dan request ,         $middleware->appendToGroup('api', EnsureUserIsCompany::class); ini harus