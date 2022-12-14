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
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh'])->name('refresh');
        Route::post('me', [\App\Http\Controllers\AuthController::class, 'me'])->name('me');
    });
});

Route::group([
    'prefix' => 'user'
], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('show/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
        Route::patch('update-profile', [\App\Http\Controllers\UserController::class, 'updateUserProfile'])->name('update-profile');
        Route::patch('update-password', [\App\Http\Controllers\UserController::class, 'updateUserPassword'])->name('update-password');
    });
});

Route::group([
    'prefix' => 'category'
], function () {
    Route::get('show/{id}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
    Route::get('/search', [\App\Http\Controllers\CategoryController::class, 'search'])->name('category.search');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    });
});

Route::group([
    'prefix' => 'post'
], function () {
    Route::get('show/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show');
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/search', [\App\Http\Controllers\PostController::class, 'search'])->name('post.search');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('store', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
        Route::patch('update/{id}', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    });

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
