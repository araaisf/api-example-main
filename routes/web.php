<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatatanWebController;

Route::get('/', function () {
    return view('welcome');
});

// HALAMAN WEB CATATAN (Blade)
Route::get('/catatan', [CatatanWebController::class, 'index'])->name('catatan.index');
Route::get('/catatan/create', [CatatanWebController::class, 'create'])->name('catatan.create');
Route::post('/catatan', [CatatanWebController::class, 'store'])->name('catatan.store');
Route::delete('/catatan/delete/{id}', [CatatanWebController::class, 'delete'])->name('catatan.delete');
