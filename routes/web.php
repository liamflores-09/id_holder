<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('documents', DocumentController::class);
    Route::post('documents/{document}/toggle-favorite', [DocumentController::class, 'toggleFavorite'])->name('documents.toggle-favorite');
    Route::post('documents/{document}/toggle-archive', [DocumentController::class, 'toggleArchive'])->name('documents.toggle-archive');
});

require __DIR__.'/auth.php';