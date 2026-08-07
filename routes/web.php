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
