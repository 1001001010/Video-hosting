<?php

use App\Http\Controllers\{ProfileController, VideoController};
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(App\Http\Controllers\VideoController::class)->group(function () { 
    Route::get('/', 'welcome' )->name('welcome');
    Route::post('/new_video', 'new_video' )->name('NewVideo');
});

require __DIR__.'/auth.php';
