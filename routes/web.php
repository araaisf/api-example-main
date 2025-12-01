<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\CatatanWebController;

Route::get('/catatan', [CatatanWebController::class, 'index'])->name('catatan.index');
Route::get('/catatan/create', [CatatanWebController::class, 'create'])->name('catatan.create');
Route::post('/catatan', [CatatanWebController::class, 'store'])->name('catatan.store');
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-api', function () {
    return view('test');
});

Route::get('/crud', function () {
    return view('crud');
});

