<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('index');
});


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware(['auth'])->group(function(){

    Route::get('/userdash', function(){
        return view('userdash');
    })->name('userdash');
    
    Route::get('/admindash', function(){

        return view('admindash');
    })->name('admindash');


});
