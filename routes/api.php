<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => '/auth'], function ($router) {
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('register');
    Route::get('resetPassword/{email}', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('savePassword', [\App\Http\Controllers\Api\AuthController::class, 'savePasswordReset'])->name('savePasswordReset');
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [\App\Http\Controllers\Api\AuthController::class, 'me'])->name('me');

    Route::group(['prefix' => '/product'], function($router) {
        Route::post('/', [\App\Http\Controllers\Api\ProductController::class, 'store']);
        Route::get('/list', [\App\Http\Controllers\Api\ProductController::class, 'getList']);
        Route::get('/{id}', [\App\Http\Controllers\Api\ProductController::class, 'index']);
        Route::put('/update/{id}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\ProductController::class, 'delete']);
    });
    Route::group(['prefix' => '/shopping-list'], function($router) {
        Route::post('/', [\App\Http\Controllers\Api\ShoppingListController::class, 'store']);
        Route::get('/list/{userId}', [\App\Http\Controllers\Api\ShoppingListController::class, 'getList']);
        Route::get('/{id}', [\App\Http\Controllers\Api\ShoppingListController::class, 'index']);
        Route::put('/{id}', [\App\Http\Controllers\Api\ShoppingListController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\ShoppingListController::class, 'delete']);
    });

    Route::group(['prefix' => '/address'], function($router) {
        Route::post('/', [\App\Http\Controllers\AddressController::class, 'store']);
        Route::get('/{userId}', [\App\Http\Controllers\AddressController::class, 'findByUser']);
        Route::put('/{id}', [\App\Http\Controllers\AddressController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\AddressController::class, 'delete']);
    });

    Route::group(['prefix' => '/utils'], function($router) {
        Route::get('/document-type', [\App\Http\Controllers\DocumentTypeController::class, 'find']);
        Route::get('/departments', [\App\Http\Controllers\DepartmentsController::class, 'find']);
        Route::get('/countries', [\App\Http\Controllers\CountriesController::class, 'find']);
        Route::get('/cities', [\App\Http\Controllers\CitiesController::class, 'find']);
    });

    Route::group(['prefix' => '/discounts'], function($router) {
        Route::post('/', [\App\Http\Controllers\DiscountsController::class, 'store']);
        Route::get('/{userId}', [\App\Http\Controllers\DiscountsController::class, 'findByProduct']);
        Route::put('/{id}', [\App\Http\Controllers\DiscountsController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\DiscountsController::class, 'delete']);
    });

    Route::group(['prefix' => '/category'], function($router) {
        Route::post('/', [\App\Http\Controllers\CategoryController::class, 'store']);
        Route::get('/{userId}', [\App\Http\Controllers\CategoryController::class, 'findByUser']);
        Route::put('/{id}', [\App\Http\Controllers\CategoryController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => '/mark'], function($router) {
        Route::post('/', [\App\Http\Controllers\Api\MarkController::class, 'store']);
        Route::get('/', [\App\Http\Controllers\Api\MarkController::class, 'getList']);
        Route::put('/{id}', [\App\Http\Controllers\Api\MarkController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\MarkController::class, 'delete']);
    });
});
