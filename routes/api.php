<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser'])->name('login');
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('feedbacks', FeedbackController::class)->only(['index', 'store']);
    Route::resource('products', ProductController::class);
    Route::resource('comments', CommentController::class)->only(['index', 'store']);
    Route::get('/users/search', [UserController::class, 'search']);
});

