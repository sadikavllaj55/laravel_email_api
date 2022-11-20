<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return [
        "name" => config('app.name'),
        "endpoints" => [
            'users' => \route('user.list'),
            'posts' => \route('post.list'),
            'latest_posts'=> \route('post.latest')
        ]
    ];
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('post.list');
    Route::get('/posts/latest', 'latestMail')->name('post.latest');
    Route::get('/posts/{id}', 'show')->name('post.show');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('user.list');
    Route::get('/users/{id}', 'show')->name('user.show');
});
