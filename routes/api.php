<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\InvestorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/save-step-data', [EntrepreneurController::class, 'saveStepData'])->name('save-step-data');
Route::get('/get-step-data', [EntrepreneurController::class, 'getStepData'])->name('get-step-data');
//investor

Route::post('/investor-save-step-data', [InvestorController::class, 'saveStepData'])->name('investor-save-step-data');
Route::get('/investor-get-step-data', [InvestorController::class, 'getStepData'])->name('investor-get-step-data');

Route::get('/hello', function () {
    return "hello";  // 'return' keyword missing tha
});