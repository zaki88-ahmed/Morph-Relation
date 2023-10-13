<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/posts', [PostController::class, 'allPosts']);
Route::post('/post/create', [PostController::class, 'addPost']);
Route::get('/post/show', [PostController::class, 'specificPost']);
Route::post('/post/edit', [PostController::class, 'updatePost']);
Route::post('/post/delete', [PostController::class, 'deletePost']);
//Route::get('/post/restore', [PostController::class, 'specificPost']);

Route::get('/comments', [CommentController::class, 'allComments']);
Route::post('/comment/create', [CommentController::class, 'addComment']);
Route::get('/comment/show', [CommentController::class, 'specificComment']);
Route::post('/comment/edit', [CommentController::class, 'updateComment']);
Route::post('/comment/delete', [CommentController::class, 'deleteComment']);
Route::post('/comment/toggle', [CommentController::class, 'toggleComment']);



Route::get('/pages', [PageController::class, 'allPAges']);
Route::get('/trashed/pages', [PageController::class, 'getTrashedPages']);
Route::post('/page/create', [PageController::class, 'addPage']);
Route::get('/page/show', [PageController::class, 'specificPage']);
Route::post('/page/edit', [PageController::class, 'updatePage']);
Route::post('/page/restore', [PageController::class, 'restorePage']);
Route::post('/page/delete', [PageController::class, 'deletePage']);
Route::post('/page/remove', [PageController::class, 'removePage']);
Route::post('/page/toggle', [PageController::class, 'togglePage']);
//Route::post('/page/deactivate', [CommentController::class, 'togglePage']);
Route::post('/upload/page/loge', [PageController::class, 'uploadLogo']);
Route::post('/upload/page/cover', [PageController::class, 'uploadCover']);



Route::get('/categories', [CategoryController::class, 'allCategories']);
Route::post('/category/create', [CategoryController::class, 'addCategory']);
Route::get('/category/show', [CategoryController::class, 'specificCategory']);
Route::post('/category/edit', [CategoryController::class, 'updateCategory']);
Route::post('/category/delete', [CategoryController::class, 'deleteCategory']);
Route::post('/category/restore', [CategoryController::class, 'restoreCategory']);
