<?php

use App\Http\Controllers\Inertia\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
Route::get('/cabinet', function () {
    return Inertia::render('Do-app/Cabinet', [

    ]);
});

Route::group([
    'prefix' => 'post'
], function () {
    Route::get('show/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/search', [PostController::class, 'search'])->name('post.search');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::patch('update/{id}', [PostController::class, 'update'])->name('post.update');
    });

});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
