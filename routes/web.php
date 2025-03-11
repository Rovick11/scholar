<?php
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('userdash');
});

Route::get('/userdash', [PageController::class, 'showAppSub'])->name('appSub');
