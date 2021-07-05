<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TagController;

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

Route::get('/hello', function (Request $request){
    return "Hello World";
});

Route::get('/goodbye/{name}', function ($name) {
    return 'Goodbye '.$name;
});
Route::post('/info', function (Request $request) {
    return 'Hello  '.$request['name'].' You are '.$request['age'].' years old';
});


// Create

Route::post('/posts',[PostController::class, 'createPost']);

// Read

Route::get('/posts',[PostController::class, 'getAllPost']);
Route::get('/posts/{id}',[PostController::class, 'getPostById']);

// Update

Route::put('/posts/{id}',[PostController::class, 'updatePost']);

//Delete

Route::delete('/posts/{id}',[PostController::class, 'deletePost']);


//Create reviews
Route::post('/posts/{id}/reviews',[ReviewController::class, 'create']);

//Get all reviews
Route::get('/posts/{id}/reviews',[ReviewController::class, 'index']);

//Get  review by ID
Route::get('/posts/{id}/reviews/{review_id}',[ReviewController::class, 'show']);

//Update  review 
Route::put('/posts/{id}/reviews/{review_id}',[ReviewController::class, 'update']);

//Delete  review 
Route::delete('/posts/{id}/reviews/{review_id}',[ReviewController::class, 'delete']);


Route::post('/tags',[TagController::class, 'create']);
Route::get('/tags',[TagController::class, 'getAllTags']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
