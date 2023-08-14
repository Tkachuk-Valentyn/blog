<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/first', [TestController::class, 'clockAngle']);
Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::put('/posts', [PostsController::class, 'store']);
        Route::post('/posts/{id}', [PostsController::class, 'update']);
        Route::delete('/posts/{id}', [PostsController::class, 'destroy']);


    });

    Route::middleware('role:user|admin')->group(function () {
        Route::get('/posts', [PostsController::class, 'showPage']);
        Route::get('/posts/{id}/comments', [CommentController::class, 'index']);
        Route::get('/posts/slug/{slug}', [PostsController::class, 'showBySlug']);
        Route::put('/posts/{id}/comments', [CommentController::class, 'store']);
        Route::post('/posts/{id}/comments/{id_comment}', [CommentController::class, 'update'])->middleware('check.id');
        Route::delete('/posts/{id}/comments/{id_comment}', [CommentController::class, 'destroy'])->middleware('check.id');
    });




});

Route::get('/users', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
