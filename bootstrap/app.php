<?php

use App\Http\Middleware\TrustProxies;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$storageBase = dirname(__DIR__).'/storage';
foreach ([
    'app/public',
    'framework/cache',
    'framework/sessions',
    'framework/testing',
    'framework/views',
    'logs',
] as $relativePath) {
    $path = $storageBase.'/'.$relativePath;

    if (! is_dir($path)) {
        @mkdir($path, 0777, true);
        @chmod($path, 0777);
    }
}

if (! is_dir(dirname(__DIR__).'/public/storage') && is_dir($storageBase.'/app/public')) {
    @symlink($storageBase.'/app/public', dirname(__DIR__).'/public/storage');
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->replace(
            \Illuminate\Http\Middleware\TrustProxies::class,
            TrustProxies::class
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
