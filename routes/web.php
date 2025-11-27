<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WhatsAppAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PropertyController; // Added PropertyController Import

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Auth Routes
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login/verify-phone', [AuthController::class, 'showOtpForm'])->name('password.otp.form');
Route::post('/login/send-otp', [WhatsAppAuthController::class, 'sendOtp'])->name('password.otp.verify');
Route::get('/login/confirm-otp', [WhatsAppAuthController::class, 'showConfirmForm'])->name('otp.confirm.form');
Route::post('/login/validate-otp', [WhatsAppAuthController::class, 'validateOtp'])->name('otp.confirm.submit');
Route::match(['get','post'],'logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Requires Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard / Map
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 1. Video Upload Page
    Route::get('/property/upload', [PropertyController::class, 'showUploadForm'])->name('property.upload');

    // 2. Handle Video Submission (Now linked to Controller)
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
});