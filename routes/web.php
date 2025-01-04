<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostLikeController;

Route::get('/', [UsersController::class, 'halamanIndex']);



Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register-berhasil', [\App\Http\Controllers\UsersController::class, 'register']);

Route::post('/login-berhasil', [\App\Http\Controllers\UsersController::class, 'login']);
Route::post('/logout', [UsersController::class, 'logout']);

Route::get('/home', [\App\Http\Controllers\UsersController::class, 'halamanHome'])->name('halaman-home');
// Route::get('/home', [\App\Http\Controllers\ImageController::class, 'tampilPostingan']);


Route::get('/upload', [ImageController::class, 'halamanCreate'])->name('image.index');
Route::post('/process', [ImageController::class, 'process'])->name('image.process');
Route::post('/image/store', [ImageController::class, 'store'])->name('post.store');
Route::post('/toggle-like', [PostLikeController::class, 'toggleLike'])->name('toggle-like');
