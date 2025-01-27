<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\SubscribeController;

Route::get('/', [UsersController::class, 'halamanIndex']);
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register-berhasil', [\App\Http\Controllers\UsersController::class, 'register']);
Route::post('/login-berhasil', [\App\Http\Controllers\UsersController::class, 'login']);




Route::middleware('auth')->group(function () {
    Route::get('/home', [\App\Http\Controllers\UsersController::class, 'halamanHome'])->name('halaman-home');
    Route::get('/policy', [UsersController::class, 'halamanPolicy']);
    Route::get('/subscribe', [SubscribeController::class, 'halamanSubscribe']);
    Route::get('/upload', [ImageController::class, 'halamanCreate'])->name('image.index');
    Route::post('/process', [ImageController::class, 'process'])->name('image.process');
    Route::post('/image/store', [ImageController::class, 'store'])->name('post.store');
    Route::post('/toggle-like', [PostLikeController::class, 'toggleLike'])->name('toggle-like');
    Route::post('/follow/{user_id}', [FollowController::class, 'toggleFollow'])->name('follow.toggle');
    Route::get('/comment/{id_post}', [CommentController::class, 'halamanComment'])->name('comment');
    Route::post('/commented', [CommentController::class, 'tambahComment']);
    Route::get('/profile/{user_id}', [ProfileController::class, 'getProfile'])->name('profile');
    Route::get('/setting/{sessionId}', [ProfileController::class, 'setting'])->name('setting');
    Route::put('/edit-profile/{sessionId}', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/generate-snap-token', [SubscribeController::class, 'generateSnapToken'])->name('generate.snap.token');
    Route::post('/post-payment-success', [SubscribeController::class, 'postPaymentSuccess'])->name('post.payment.success');

    Route::post('/logout', [UsersController::class, 'logout']);
});
