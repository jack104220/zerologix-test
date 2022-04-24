<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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

Route::prefix('users')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('login.check');
    Route::post('/follow', [UserController::class, 'follow'])->middleware('login.check');
});

Route::apiResource('articles', ArticleController::class)->middleware('login.check');

Route::prefix('articles')->middleware('login.check')->group(function () {
    Route::post('/{articleId}/favorite', [ArticleController::class, 'favorite']);
    Route::post('/{articleId}/share', [ArticleController::class, 'share']);
});

Route::apiResource('comments', CommentController::class)->middleware('login.check')->except('index');

Route::prefix('comments')->middleware('login.check')->group(function () {
    Route::post('/{commentId}/favorite', [CommentController::class, 'favorite']);
});