<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatatanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-api', function () {
    return view('test');
});

Route::get('/crud', function () {
    return view('crud');
});

