<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\GradeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\HistoryController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/grades/{id}', [GradeController::class, 'show']); // Просмотр конкретной оценки

 // Просмотр конкретного пользователя
Route::get('/users/{id}', [UserController::class, 'show'])->middleware('auth');
Route::get('/histories', [HistoryController::class, 'index']); // Просмотр всех историй
Route::get('/histories/{id}', [HistoryController::class, 'show']); // Просмотр истории

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'create']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);



    Route::post('/grades/{history_id}', [GradeController::class, 'create']); // Создание оценки

    Route::put('/grades/{id}', [GradeController::class, 'update']); // Редактирование оценки
    Route::delete('/grades/{id}', [GradeController::class, 'destroy']); // Удаление оценки

    Route::post('/users/{id}', [UserController::class, 'update']); // Редактирование пользователя

    Route::post('/histories', [HistoryController::class, 'create']); // Создание истории ----------- //

    Route::get('/users/user/{id}', [UserController::class, 'showforuser']);
    Route::get('/users/admin/{id}', [UserController::class, 'showforadmin']);
    Route::get('/all/users', [UserController::class, 'indexusers']);
    Route::get('/all/admins', [UserController::class, 'indexadmins']);
    Route::delete('/users/user/{id}', [UserController::class, 'destroy']);
});


Route::get('/users/guest/{id}', [UserController::class, 'showforguest']);
























