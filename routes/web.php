<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApplicationSubmissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailOtpController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\sendEmail;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\ScholarshipController;

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
Route::post('/submissions/{id}/reject', [ApplicationSubmissionController::class, 'reject'])->name('submission.reject');


Route::post('/claim-scholarship', [ClaimController::class, 'claimScholarship']);
Route::post('/claim-scholarship', [ScholarshipController::class, 'claimScholarship']);



Route::middleware(['auth'])->group(function () {
    Route::get('/userdash', function () {
        return view('userdash');
    })->name('userdash');

    Route::get('/admindash', function () {
        return view('admindash');
    })->name('admindash');

});





Route::get('/notifications/fetch', [NotificationController::class, 'fetchNotifications'])->name('notifications.fetch');



Route::get('/admindash', [PageController::class, 'showadmindash'])->name('admindash');
Route::get('/scholarman', [PageController::class, 'showAdmin_ScholarMan'])->name('admin_scholarMan');
Route::get('/admin_scholarAward', [PageController::class, 'showAdmin_ScholarAward'])->name('admin_scholarAward');
Route::get('/admin_award', [PageController::class, 'showAdmin_SAward'])->name('admin_award');
Route::get('/admin_reportAna', [ApplicationSubmissionController::class, 'showReports'])->name('admin_reportAna');
Route::get('/admin_addNewSem', [PageController::class, 'showAdmin_AddNewSem'])->name('admin_addNewSem');
Route::get('/admin_history', [PageController::class, 'showAdmin_History'])->name('admin_history');
Route::get('/user_acceptForm', [PageController::class, 'showUser_AcceptForm'])->name('user_acceptForm');
Route::get('/user_renewal', [PageController::class, 'showUser_Renewal'])->name('user_renewal');
Route::put('/documents/update/{id}', [ApplicationSubmissionController::class, 'update'])->name('document.update');


Route::post('/send-otp', [EmailOtpController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [EmailOtpController::class, 'verifyOtp'])->name('verify.otp');
Route::put('/update-profile/{id}', [EmailOtpController::class, 'updateProfile'])->name('userprofile.update');
Route::post('/send-email/{id}', [sendEmail::class, 'sendEmail'])->name('sendemail');


Route::get('/admin_scholarAward', [ApplicationSubmissionController::class, 'showApproved'])->name('admin_scholarAward');

Route::get('/admindash', [ApplicationSubmissionController::class, 'showDashboard'])->name('admindash');

