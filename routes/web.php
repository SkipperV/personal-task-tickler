<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [HomepageController::class, 'index'])->name('home.index');

    Route::get('/spaces', [SpaceController::class, 'index'])->name('spaces.index');

    Route::get('/spaces/{space}/all', [SpaceController::class, 'show'])->name('spaces.show');
    Route::get('/spaces/{space}/archived', [SpaceController::class, 'show'])->name('spaces.tasks.archived');
});

//Admin (Currently for testing purposes)
Route::middleware('auth')->group(function () {
    Route::get('/tasks/all', [TaskController::class, 'index'])->name('tasks.index');
});

require __DIR__ . '/auth.php';
