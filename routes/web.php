<?php

use App\Http\Controllers\{ProfileController, VideoController};
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(App\Http\Controllers\VideoController::class)->group(function () { 
    Route::get('/', 'welcome' )->name('welcome');
    Route::get('/dashboard', 'dashboard' )->middleware(['auth'])->name('dashboard');
    Route::post('/new_video', 'new_video' )->name('NewVideo');
    Route::get('/video/{id}', 'watch_video' )->name('watchVideo');
    Route::get('/video/{id}/{status}', 'ban_video' )->name('BanVideo');
    Route::get('/video/{id}/like/{status}', 'like_video' )->name('LikeVideo');
    Route::post('/video/{id}/newComment', 'new_comment' )->name('newComment');
});

Route::controller(App\Http\Controllers\CategoryController::class)->group(function () { 
    Route::get('/category', 'category_list' )->name('category_list');
    Route::post('/new_category', 'new_category' )->name('NewCategory');
});

require __DIR__.'/auth.php';
