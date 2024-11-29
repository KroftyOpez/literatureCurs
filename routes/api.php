<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\GradeController;
use \App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'create']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);



    Route::post('/grade/{history_id}', [GradeController::class, 'create']); // Создание оценки
    Route::get('/grade/{id}', [GradeController::class, 'show']); // Просмотр конкретной оценки
    Route::put('/grade/{id}', [GradeController::class, 'update']); // Редактирование оценки
    Route::delete('/grade/{id}', [GradeController::class, 'destroy']); // Удаление оценки


    Route::get('/user/{id}', [UserController::class, 'show']); // Редактирование пользователя
    Route::put('/user/{id}', [UserController::class, 'update']); // Просмотр конкретного пользователя
});
























