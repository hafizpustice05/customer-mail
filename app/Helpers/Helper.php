<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class Helper
{
    public static function logError(string $errorMessage): void
    {
        Log::error([
            'class' => Route::currentRouteAction(),
            'url' => \url()->current(),
            'error' => $errorMessage
        ]);
    }
    public static function logInfo(string|array $errorMessage): void
    {
        Log::info([
            'class' => Route::currentRouteAction(),
            'url' => \url()->current(),
            'error' => $errorMessage
        ]);
    }
    public static function logDebug(string|array $errorMessage): void
    {
        Log::debug([
            'class' => Route::currentRouteAction(),
            'url' => \url()->current(),
            'error' => $errorMessage
        ]);
    }

    public static function testHelper(): string
    {
        return 'test-Helper';
    }
}
