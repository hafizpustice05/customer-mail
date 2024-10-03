<?php

use App\Helpers\Helper;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\Blog\CategoryController;
use App\Http\Controllers\Auth\Blog\DashboardController;
use App\Http\Controllers\Auth\Blog\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/create-user', [AuthController::class, 'create']);
// dd(app());
Route::view('/login', 'auth.login')->name('login');
Route::post('login', [AuthController::class, 'login'])->name('signIn');

Route::get('create', [HomeController::class, 'create']);
Route::get('list', [HomeController::class, 'customersWithCountryPostCode']);
// return Artisan::call('app:send-good-morning-cron-job');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('home', function () {
    return
        view('welcome');
})->name('home');


Route::get('/', function () {
    // return Helper::testHelper();
    return 'logout';
})->name('home');

//
Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class,
    ]);
    Route::delete('admin/category/delete',[PostController::class,'delete'] );
});
