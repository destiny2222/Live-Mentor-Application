<?php

use App\Http\Middleware\AdminLog;
use App\Http\Middleware\AdminLogged;
use App\Http\Middleware\LastActivityUser;
use App\Http\Middleware\UserAuthentication;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;




return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->use([ ]);
        $middleware->alias([
            'Share' => Jorenvh\Share\ShareFacade::class,
            'admin.logged_in'=> AdminLog::class,
            'admin.logged_out'=> AdminLogged::class,
            'authentication.user'=>UserAuthentication::class,
            'last.activity.user' => LastActivityUser::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/dashboard/payment/*',
			// 'http://example.com/foo/bar',
			// 'http://example.com/foo/*',
		]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
