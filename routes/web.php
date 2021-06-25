<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::get('/', function(){
    return redirect('/posts');
});

Route::get('/home', function(){
    return redirect('/posts');
});

Route::get('/posts', [PostController::class, 'index'])->name('index');
Route::view('/posts/create', 'posts.create');
Route::get('/posts/myPosts', [PostController::class, 'userPosts'])->name('misPosts');
Route::view('/user/count', 'usuarios.count');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('post');
Route::post('/comments', [CommentController::class, 'store']);
Route::post('/posts/create', [PostController::class, 'store']);
Route::post('/user/count/{id}', [UserController::class, 'editar_usuario'])->name('editar_usuario');
Route::get('/user/delcount', [UserController::class, 'eliminar_usuario'])->name('eliminar_usuario');
Route::delete('/posts/myPosts/{id}', [PostController::class, 'eliminar_posts']);


Auth::routes();

Route::get(
    '/home', 
    [App\Http\Controllers\PostController::class, 'index'])->name('home');