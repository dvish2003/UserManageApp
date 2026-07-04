<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

#User Routes
Route::get('/users',            [UserController::class, 'index']);
Route::post('/users',           [UserController::class, 'store']);
Route::get('/users/{email}',    [UserController::class, 'show']);
Route::put('/users/{email}',    [UserController::class, 'update']);
Route::delete('/users/{email}', [UserController::class, 'destroy']);


#Auth Routes
Route::post('/auth/register', [AuthController::class, 'store']);
Route::post('/auth/login', [AuthController::class, 'show']);
