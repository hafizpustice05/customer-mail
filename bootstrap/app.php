<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use Illuminate\Support\Facades\Schedule;
use Illuminate\Console\Scheduling\Schedule;

// dd(dirname(__DIR__));

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

    )
    ->withMiddleware(function (Middleware $middleware) {
        // dd(app());
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('app:send-good-morning-cron-job');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// dd($app);
return $app;
