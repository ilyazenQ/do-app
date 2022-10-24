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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('api.register');
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('api.login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('api.logout');
        Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh'])->name('api.refresh');
        Route::post('me', [\App\Http\Controllers\Api\AuthController::class, 'me'])->name('api.me');
    });
});

Route::group([
    'prefix' => 'user'
], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('show/{id}', [\App\Http\Controllers\Api\UserController::class, 'show'])->name('api.user.show');
        Route::patch('update-profile', [\App\Http\Controllers\Api\UserController::class, 'updateUserProfile'])->name('api.update-profile');
        Route::patch('update-password', [\App\Http\Controllers\Api\UserController::class, 'updateUserPassword'])->name('api.update-password');
    });
});

Route::group([
    'prefix' => 'category'
], function () {
    Route::get('show/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'show'])->name('api.category.show');
    Route::get('/', [\App\Http\Controllers\Api\CategoryController::class, 'index'])->name('api.category.index');
    Route::get('/search', [\App\Http\Controllers\Api\CategoryController::class, 'search'])->name('api.category.search');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('store', [\App\Http\Controllers\Api\CategoryController::class, 'store'])->name('api.category.store');
    });
});

Route::group([
    'prefix' => 'post'
], function () {
    Route::get('show/{id}', [\App\Http\Controllers\Api\PostController::class, 'show'])->name('api.post.show');
    Route::get('/', [\App\Http\Controllers\Api\PostController::class, 'index'])->name('api.post.index');
    Route::get('/search', [\App\Http\Controllers\Api\PostController::class, 'search'])->name('api.post.search');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('store', [\App\Http\Controllers\Api\PostController::class, 'store'])->name('api.post.store');
        Route::patch('update/{id}', [\App\Http\Controllers\Api\PostController::class, 'update'])->name('api.post.update');
    });

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
