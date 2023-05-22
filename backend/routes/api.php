<?php

use App\Http\Controllers\DataTutorialController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\UserController;
use App\Models\DataTutorial;
use App\Models\Post;
use App\Models\Tutorial;
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
Route::get('/roadmap/{slug}', [RoadmapController::class, 'show'])->name('getRoadmapBySlug');

// get tutorial
Route::get('/tutorial', [TutorialController::class, 'index'])->name('getAllTutorial');
Route::get('/tutorial/{slug}', [TutorialController::class, 'show'])->name('getTutorialBySlug');

// get data tutorial
Route::get('/datatutorial', [DataTutorialController::class, 'index'])->name('getAllDataTutorial');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // post controller
    Route::post('/posts/{slug}', [PostController::class, 'update'])->name('updatePost');
    Route::resource('/posts', PostController::class)->except('index', 'show', 'update');

    // roadmap controller
    Route::resource('/roadmap', RoadmapController::class)->except('index', 'show');

    // tutorial controller
    Route::resource('/tutorial', TutorialController::class)->except('index', 'show');

    // data tutorial roadmap
    Route::resource('/datatutorial', DataTutorialController::class)->except('index', 'show');
});

// route 404 not found
Route::fallback(function(){
    return response()->json([
        'status' => 404,
        'message' => 'route not found',
        'detail' => 'You may not be authenticated or the route may not exist in this program'
    ], 404);
});
