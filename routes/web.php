<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OtpController;
use App\Models\Entrepreneur;
use App\Models\Investor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['entrepreneur.check'])->group(function () {

Route::get('/', [AuthController::class, 'showMobileForm'])->name('mobile.form');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

Route::get('/create-password/{email}', [AuthController::class, 'showPasswordForm'])->name('password.form');
Route::post('/create-password', [AuthController::class, 'createPassword'])->name('create.password');

Route::get('/verify-otp/{email}', [AuthController::class, 'showOtpForm'])->name('otp.form');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::get('/choose-role/{user_id}', [AuthController::class, 'chooseRole'])->name('choose.role');
Route::post('/set-role', [AuthController::class, 'setRole'])->name('set.role');

// });
// Entrepreneur routes
// Route::get('/entrepreneur/form/{user_id}', [EntrepreneurController::class, 'showForm'])->name('entrepreneur.form');
// Route::post('/entrepreneur/store', [EntrepreneurController::class, 'store'])->name('entrepreneur.store');

// Investor routes
Route::get('/investor/form/{user_id}', [InvestorController::class, 'showForm'])->name('investor.form');
Route::post('/investor/store', [InvestorController::class, 'store'])->name('investor.store');

//serach route
Route::get('/search', [EntrepreneurController::class, 'approvedEntrepreneurs'])->name('search');
Route::post('/entrepreneur/toggle-approval', [EntrepreneurController::class, 'toggleApproval'])->name('entrepreneur.toggleApproval');

Route::post('/investor/toggle-approval', [InvestorController::class, 'toggleApproval'])->name('investor.toggleApproval');

// Route::middleware(['auth', 'entrepreneur.check'])->group(function () {
Route::get('/entrepreneur/form/{user_id}', [EntrepreneurController::class, 'showForm'])->name('entrepreneur.form');
Route::post('/entrepreneur/store', [EntrepreneurController::class, 'store'])->name('entrepreneur.store');
// });

//login
Route::get('/login', [LoginController::class, 'Login'])->name('login');
Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login.process');

Route::get('/my-companies', [EntrepreneurController::class, 'myCompanies'])->name('my.companies')->middleware('auth');

Route::get('/investor-companies', [InvestorController::class, 'myCompanies'])->name('investor.companies')->middleware('auth');
Route::post('investor/company/store', [InvestorController::class, 'storeCompany'])->name('investor.company.store');

Route::post('/company/store', [EntrepreneurController::class, 'storeCompany'])->name('company.store');
Route::put('/company/{id}', [EntrepreneurController::class, 'updateCompany'])->name('company.update');
Route::delete('/entrepreneurs/{id}', [EntrepreneurController::class, 'destroy'])->name('entrepreneurs.destroy');

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/investors', [InvestorController::class, 'getInvestore'])->name('admin.investors');
    Route::get('/entrepreneurs', [EntrepreneurController::class, 'getEntrepreneur'])->name('admin.entrepreneurs');
    Route::get('/users', [AuthController::class, 'getUser'])->name('admin.users');
    Route::get('/entrepreneurs/download/csv', [EntrepreneurController::class, 'downloadCSV'])->name('admin.download');
    Route::get('/investors/download/csv', [InvestorController::class, 'downloadCSV'])->name('admin.investor.download');
    Route::post('/admin/update-pitch-video', [EntrepreneurController::class, 'updatePitchVideo'])->name('admin.update.pitch_video');
    Route::post('/admin/update-product-logo', [EntrepreneurController::class, 'updateProductLogo'])->name('admin.update.product_logo');

    Route::post('/admin/update-investor-photo-logo', [InvestorController::class, 'updatePhotosLogo'])->name('admin.update.photo.logo');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::post('/logout', function () {
    //     Auth::logout();
    //     return redirect('/login');
    // })->name('logout');
});

//admin route
Route::post('/save-step-data', [EntrepreneurController::class, 'saveStepData']);
Route::get('/get-step-data', [EntrepreneurController::class, 'getStepData'])->name('get-step-data');

// Route::get('/investor', [InvestorController::class, 'getInvestore'])->name('investore');
// Route::get('/entrepreneur', [EntrepreneurController::class, 'getEntrepreneur'])->name('entrepreneur');
Route::get('/investor/{id}/companies', [InvestorController::class, 'getCompanies']);
Route::get('/entrepreneur/{id}/companies', [EntrepreneurController::class, 'getEntrepreneurCompanies']);

// forget password 
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/entrepreneur/edit', [EntrepreneurController::class, 'edit'])->name('entrepreneur.edit');
Route::post('/entrepreneur/update', [EntrepreneurController::class, 'update'])->name('entrepreneur.update');


//investor update 

Route::get('/investor/edit', [InvestorController::class, 'edit'])->name('investor.edit');
Route::post('/investor/update/{id}', [InvestorController::class, 'update'])->name('investor.update');


Route::post('/mark-interested', [InvestorController::class, 'markInterested'])->name('mark.interested');
Route::post('/entrepreneur/remark', [EntrepreneurController::class, 'storeRemark'])->name('entrepreneur.remark');
Route::post('/entrepreneur/reject', [EntrepreneurController::class, 'reject'])->middleware('auth')->name('entrepreneur.reject');


;
//contact route 
// routes/web.php
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/support', [ContactController::class, 'support'])->name('support');
Route::get('/terms-of-service', [ContactController::class, 'termsService'])->name('service');
Route::get('/guidelines', [ContactController::class, 'Guidelines'])->name('guidelines');
Route::get('/privacy-policy', [ContactController::class, 'privacyPolicy'])->name('policy');


Route::get('/change-password', [LoginController::class, 'showChangePasswordForm'])->name('change.password');
Route::post('/change-password', [LoginController::class, 'changePassword'])->name('change.password.post');

Route::get('/not-allowed', function () {
    return view('not-allowed');
})->name('not-allowed');