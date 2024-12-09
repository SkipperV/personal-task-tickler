<?php

use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskStatusController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');

        Route::get('/spaces', [SpaceController::class, 'index'])->name('spaces.index');
        Route::get('/spaces/{space}', [SpaceController::class, 'show'])->name('spaces.show');
        Route::get('/spaces/{space}/tasks', [SpaceController::class, 'tasks'])->name('spaces.tasks.index');

        Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

        // Currently for testing
        Route::get('spaces/{space}/task-statuses', [TaskStatusController::class, 'index'])->name('spaces.statuses.index');
        Route::get('spaces/{space}/task-statuses/{taskStatus}', [TaskStatusController::class, 'show'])->name('spaces.statuses.show');
        Route::get('/tasks/all', [TaskController::class, 'index'])->name('tasks.index');
    });
});
