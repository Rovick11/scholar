<?php
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('userdash');
});

Route::get('/user_appSub', [PageController::class, 'showUser_AppSub'])->name('user_appSub');
Route::get('/user_appStatus', [PageController::class, 'showUser_AppStatus'])->name('user_appStatus');
Route::get('/user_docUpload', [PageController::class, 'showUser_DocUpload'])->name('user_docUpload');