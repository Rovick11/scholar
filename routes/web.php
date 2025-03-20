<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApplicationSubmissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailOtpController;
Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user_appStatus', [ApplicationSubmissionController::class, 'showApplicationStatus'])->name('user_appStatus');
    ;
});

Route::get('/user_appSub', [ApplicationSubmissionController::class, 'getUser'])->middleware('auth')->name('user_appSub');   
Route::get('/user_docUpload', [ApplicationSubmissionController::class, 'getUserDoc'])->middleware('auth')->name('user_docUpload');   
Route::get('/user_appSub', [ApplicationSubmissionController::class, 'getUser'])->middleware('auth')->name('user_appSub');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/user_appSub', [ApplicationSubmissionController::class, 'applicationForm'])->middleware('auth')->name('applicationForm');
Route::get('/admin_userAppMan', [ApplicationSubmissionController::class, 'showSubmissions'])->name('admin_userAppMan');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/submissions/{id}/approve', [ApplicationSubmissionController::class, 'approveSubmission'])->name('submissions.approve');

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
Route::get('/admin_scholarAward', [PageController::class, 'showAdmin_ScholarAward'])->name('admin_scholarAward');
Route::get('/admin_reportAna', [PageController::class, 'showAdmin_ReportAna'])->name('admin_reportAna');
Route::get('/admin_addNewSem', [PageController::class, 'showAdmin_AddNewSem'])->name('admin_addNewSem');
Route::get('/admin_history', [PageController::class, 'showAdmin_History'])->name('admin_history');
Route::get('/user_acceptForm', [PageController::class, 'showUser_AcceptForm'])->name('user_acceptForm');
Route::get('/user_renewal', [PageController::class, 'showUser_Renewal'])->name('user_renewal');
Route::put('/documents/update/{id}', [ApplicationSubmissionController::class, 'update'])->name('document.update');


Route::post('/send-otp', [EmailOtpController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [EmailOtpController::class, 'verifyOtp'])->name('verify.otp');
Route::put('/update-profile/{id}', [EmailOtpController::class, 'updateProfile'])->name('userprofile.update');
