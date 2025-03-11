<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('index');
});


Route::post('/register', [AuthController::class, 'register'])->name('register');
