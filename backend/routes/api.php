<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\UserController;
use App\Models\Post;
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

Route::post('/login', [UserController::class, 'login'])->name('login');

// get post
Route::get('/posts', [PostController::class, 'index'])->name('getAllPost');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('getPostsBySlug');

// get roadmap
Route::get('/roadmap', [RoadmapController::class, 'index'])->name('getAllRoadmap'); 

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // post controller
    Route::post('/posts/{slug}', [PostController::class, 'update'])->name('updatePost');
    Route::resource('/posts', PostController::class)->except('index', 'show', 'update');

    // roadmap controller
    Route::resource('/roadmap', RoadmapController::class)->except('index', 'show');
});

// route 404 not found
Route::fallback(function(){
    return response()->json([
        'status' => 404,
        'message' => 'not found',
    ], 404);
});
