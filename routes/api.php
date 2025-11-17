<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\CatatanController;

// User CRUD
Route::get('/users', [UserApiController::class, 'index']);
Route::post('/users', [UserApiController::class, 'store']);
Route::get('/users/{id}', [UserApiController::class, 'show']);
Route::put('/users/{id}', [UserApiController::class, 'update']);
Route::delete('/users/{id}', [UserApiController::class, 'destroy']);

// Catatan CRUD
Route::get('/catatan', [CatatanController::class, 'index']);
Route::post('/catatan', [CatatanController::class, 'store']);
Route::get('/catatan/{id}', [CatatanController::class, 'show']);
Route::put('/catatan/{id}', [CatatanController::class, 'update']);
Route::delete('/catatan/{id}', [CatatanController::class, 'destroy']);
