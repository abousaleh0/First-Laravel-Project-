<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

#-------------------------------------------------------------------------------
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
#-------------------------------------------------------------------------------

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('tasks', TaskController::class);

    Route::get('task/all', [TaskController::class, 'getAllTasks'])->middleware('CheckUser');
    Route::get('task/ordered', [TaskController::class, 'getTasksByPriority']);

    Route::prefix('tasks')->group(function () {
        Route::get('/{id}/user', [TaskController::class, 'getTaskUser']);
        Route::post('/{taskId}/categories', [TaskController::class, 'addCategoriesToTask']);
        Route::get('/{taskId}/categories', [TaskController::class, 'getTaskCategories']);
    });

    Route::get('categories/{categoryId}/tasks', [TaskController::class, 'getCategoriesTask']);

    Route::prefix('task')->group(function () {
        Route::post('/{id}/favorite', [TaskController::class, 'addToFavorites']);
        Route::delete('/{id}/favorite', [TaskController::class, 'removeFromFavorites']);
        Route::get('/favorites', [TaskController::class, 'getFavoritesTasks']);
    });

    #------------------------------------------------------------------------------
    Route::prefix('profile')->group(function () {
        Route::post('', [ProfileController::class, 'store']);
        Route::get('', [ProfileController::class, 'show']);
        Route::put('', [ProfileController::class, 'update']);
    });

    #------------------------------------------------------------------------------ 
    Route::get('user', [UserController::class, 'getUser']);
    Route::get('Allusers', [UserController::class, 'getAllUsers']);

    #------------------------------------------------------------------------------
});
