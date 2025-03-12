<?php
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('userdash');
});


Route::post('/register', [AuthController::class, 'register'])->name('register');
