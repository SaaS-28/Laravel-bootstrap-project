<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Whoever makes this get request, he will get the hompage returned
Route::get('/', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});

// Whoever makes this post request in request, he will register (this is handled by the UserController)
Route::post('/register', [UserController::class, 'register']);

// Whoever makes this post request in login, he will login (this is handled by the UserController)
Route::post('/login', [UserController::class, 'login']);

// Whoever makes this post request in logout, he will logout (this is handled by the UserController)
Route::post('/logout', [UserController::class, 'logout']);

// Whoever makes this post request in logout, he will create a post (this is handled by the PostController)
Route::post('/create-post', [PostController::class, 'createPost']);

// Whoever makes this post request in logout, he will go to the page where he can modify the post (this is handled by the PostController)
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);

// Whoever makes this post request in logout, he will get his post updated (this is handled by the PostController)
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);

// Whoever makes this post request in logout, he will get his post deleted (this is handled by the PostController)
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
