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
        Route::post('/', [\App\Http\Controllers\ProductController::class, 'store']);
        Route::get('/list', [\App\Http\Controllers\ProductController::class, 'getList']);
        Route::get('/{id}', [\App\Http\Controllers\ProductController::class, 'findById']);
        Route::put('/update/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\ProductController::class, 'delete']);
    });

    Route::group(['prefix' => '/utils'], function($router) {
        Route::get('/document-type', [\App\Http\Controllers\DocumentTypeController::class, 'find']);
        Route::get('/departments', [\App\Http\Controllers\DepartmentsController::class, 'find']);
        Route::get('/countries', [\App\Http\Controllers\CountriesController::class, 'find']);
        Route::get('/cities', [\App\Http\Controllers\CitiesController::class, 'find']);
        Route::get('/payment-method', [\App\Http\Controllers\PaymentMethodController::class, 'find']);
    });

    Route::group(['prefix' => '/category'], function($router) {
        Route::get('/list', [\App\Http\Controllers\CategoriesController::class, 'getAll']);
    });

    Route::group(['prefix' => '/brand'], function($router) {
        Route::get('/list', [\App\Http\Controllers\BrandsController::class, 'getAll']);
    });

    Route::group(['prefix' => '/company'], function($router) {
        Route::get('/all', [\App\Http\Controllers\CompaniesController::class, 'getAll']);
        Route::put('/update/{id}', [\App\Http\Controllers\CompaniesController::class, 'update']);
        Route::get('/{id}', [\App\Http\Controllers\CompaniesController::class, 'find']);
        Route::post('/payment-methods', [\App\Http\Controllers\CompaniesController::class, 'storePaymentMethod']);
        Route::delete('/payment-methods/{id}', [\App\Http\Controllers\CompaniesController::class, 'deletePaymentMethod']);
    });

    Route::group(['prefix' => '/user'], function($router) {
        Route::put('/update/{id}', [\App\Http\Controllers\UserController::class, 'update']);
        Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'find']);
        Route::group(['prefix' => '/address'], function($router) {
            Route::post('/', [\App\Http\Controllers\AddressController::class, 'store']);
            Route::get('/{userId}', [\App\Http\Controllers\AddressController::class, 'findByUser']);
            Route::put('/update/{id}', [\App\Http\Controllers\AddressController::class, 'update']);
            Route::delete('/delete/{id}', [\App\Http\Controllers\AddressController::class, 'delete']);
        });
    });

    Route::group(['prefix' => '/complaints'], function($router) {
        Route::post('/', [\App\Http\Controllers\ComplaintsController::class, 'store']);
        Route::get('/{userId}', [\App\Http\Controllers\ComplaintsController::class, 'storByUser']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\ComplaintsController::class, 'delete']);
    });

    Route::group(['prefix' => '/discount-promotions'], function($router) {
        Route::post('/', [\App\Http\Controllers\DiscountPromotionsController::class, 'store']);
        Route::get('/specific/{id}', [\App\Http\Controllers\DiscountPromotionsController::class, 'getById']);
        Route::get('/', [\App\Http\Controllers\DiscountPromotionsController::class, 'getAll']);
        Route::put('/{userId}', [\App\Http\Controllers\DiscountPromotionsController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\DiscountPromotionsController::class, 'delete']);
    });

    Route::group(['prefix' => '/comments'], function($router) {
        Route::post('/', [\App\Http\Controllers\CommentsController::class, 'store']);
        Route::get('/all/{productId}', [\App\Http\Controllers\CommentsController::class, 'getAllByProduct']);
        Route::put('/{userId}', [\App\Http\Controllers\CommentsController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\CommentsController::class, 'delete']);
    });
});
