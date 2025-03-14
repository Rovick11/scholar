<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApplicationSubmissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user_appStatus', [ApplicationSubmissionController::class, 'showApplicationStatus'])->name('user_appStatus');;
});

Route::get('/user_appSub', [ApplicationSubmissionController::class, 'getUser'])->middleware('auth')->name('user_appSub');   
Route::get('/user_docUpload', [PageController::class, 'showUser_DocUpload'])->name('user_docUpload');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/user_appSub', [ApplicationSubmissionController::class, 'applicationForm'])->middleware('auth')->name('applicationForm');
Route::post('/logout', [AuthController::class,  'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/userdash', function () {
        return view('userdash');
    })->name('userdash');

    Route::get('/admindash', function () {
        return view('admindash');
    })->name('admindash');

});

Route::get('/admindash', [PageController::class, 'showadmindash'])->name('admindash');
Route::get('/scholarman', [PageController::class, 'showAdmin_ScholarMan'])->name('admin_scholarMan');
Route::get('/userapp', [PageController::class, 'showAdmin_UserAppMan'])->name('admin_userAppMan');
Route::get('/admin_scholarAward', [PageController::class, 'showAdmin_ScholarAward'])->name('admin_scholarAward');
Route::get('/admin_reportAna', [PageController::class, 'showAdmin_ReportAna'])->name('admin_reportAna');