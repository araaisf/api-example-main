<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\CatatanController;

/*
|-------------------------
| CATATAN CRUD (URUTAN BENAR)
|-------------------------
*/

// Read all catatan
Route::get('/catatan', [CatatanController::class, 'index']);

// Create catatan
Route::post('/catatan', [CatatanController::class, 'store']);

// Read detail catatan
Route::get('/catatan/{id}', [CatatanController::class, 'show']);

// Update catatan
Route::put('/catatan/{id}', [CatatanController::class, 'update']);

// Delete catatan
Route::delete('/catatan/{id}', [CatatanController::class, 'destroy']);

