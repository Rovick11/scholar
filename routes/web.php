<?php
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('userdash');
});

Route::get('/user_appSub', [PageController::class, 'showUser_AppSub'])->name('user_appSub');
Route::get('/user_appStatus', [PageController::class, 'showUser_AppStatus'])->name('user_appStatus');
Route::get('/user_docUpload', [PageController::class, 'showUser_DocUpload'])->name('user_docUpload');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function() {
    Route::get('/userdash', function() {
        return view('userdash'); 
    })->name('userdash');

    Route::get('/admindash', function() {
        return view('admindash'); 
    })->name('admindash');
});


