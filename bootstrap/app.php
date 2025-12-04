<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        // Se quiser usar api.php e console.php no futuro,
        // basta criar os arquivos e adicionar aqui:
        // api: __DIR__ . '/../routes/api.php',
        // commands: __DIR__ . '/../routes/console.php',
        // health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Alias do middleware de login fake
        $middleware->alias([
            'auth_fake' => \App\Http\Middleware\AuthFake::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
