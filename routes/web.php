<?php

use App\Http\Controllers\Web\ApiController;
use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\MessageController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\ObserverController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\RefundController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (converted from old site, FQCN)
|--------------------------------------------------------------------------
*/

// Public API routes (no device redirect)
Route::get('/area/city', [AreaController::class, 'getCity']);
Route::get('/area/county', [AreaController::class, 'getCounty']);
Route::get('/area/road', [AreaController::class, 'getRoad']);
Route::get('/area/shop', [AreaController::class, 'getShop']);
Route::get('/robots.txt', [ApiController::class, 'robots']);
Route::get('/sitemap.xml', [ApiController::class, 'sitemap']);
Route::get('/get711', [AreaController::class, 'get711']);
Route::post('/observer/store', [ObserverController::class, 'store']);

// Admin login routes (GET/POST login handled by Admin\LoginController)
// 1. 子域名访问: https://ami3-17drt4-6ne634russ.<域名>.com/login
Route::domain(env('ADMIN_ROUTE_DOMAIN'))->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])
        ->name('filament.' . env('ADMIN_PATH', 'ami3-17drt4-6ne634russ') . '.auth.login');
    Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])
        ->name('admin.login.submit');
    Route::post('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])
        ->name('filament.' . env('ADMIN_PATH', 'ami3-17drt4-6ne634russ') . '.auth.logout');
});

// 2. www 路径访问兼容
Route::prefix(env('ADMIN_PATH', 'ami3-17drt4-6ne634russ'))->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])
        ->name('admin.login.show');
    Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])
        ->name('admin.login.submit.path');
});

// Frontend routes with device redirect
Route::middleware(['redirect.device'])->group(function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::any('/check', [OrderController::class, 'check']);
    Route::get('/check/{no}', [OrderController::class, 'checking']);
    Route::get('/order/{no}', [OrderController::class, 'checking']);
    Route::get('/order/success/{no}', [OrderController::class, 'succeed']);
    Route::get('/refund', [RefundController::class, 'index']);
    Route::post('/refund', [RefundController::class, 'store']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/shopping/{id}', [OrderController::class, 'checkout']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/message', [MessageController::class, 'index']);
    Route::post('/message', [MessageController::class, 'store']);
    Route::get('/sitemap', [IndexController::class, 'sitemap']);
    Route::get('{uri}', [PageController::class, 'index']);
    Route::post('/api/comment/up', [ProductController::class, 'commentUp']);
});
