<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\AdminRewardController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BusinessPlanController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/plans', [PlanController::class, 'index'])->name('plans');
Route::get('/earning-details', [EarningController::class, 'index'])->name('earning-details');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// Throttled: the handler sends real email, so an unthrottled form can be
// used to bomb the support mailbox and burn the sending reputation.
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:3,5')->name('contact.store');
Route::get('/business-plan', [BusinessPlanController::class, 'index'])->name('business-plan');

// Auth Routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
// Throttled: stops bulk account creation.
Route::post('/register', [RegisterController::class, 'store'])->middleware('throttle:5,10');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset
// Guest-only: a signed-in member changing their password uses /profile, which
// also asks for the current password.
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('throttle:3,5');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])->name('password.reset');
    // Distinct name: password.reset carries a {token} segment, so it cannot
    // generate a URL for the POST.
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('throttle:5,10')->name('password.update');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Dashboard Routes (authenticated + email verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/deposit', [DepositController::class, 'show'])->name('deposit');
    Route::post('/deposit', [DepositController::class, 'store'])->middleware('throttle:10,1')->name('deposit.store');
    Route::get('/deposits/{deposit}/receipt', [DepositController::class, 'receipt'])->name('deposits.receipt');
    Route::get('/withdraw', [WithdrawController::class, 'show'])->name('withdraw');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->middleware('throttle:10,1')->name('withdraw.store');
    Route::get('/withdrawals/{withdrawal}/receipt', [WithdrawController::class, 'receipt'])->name('withdrawals.receipt');
    Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals');
    Route::get('/earnings', [EarningController::class, 'earnings'])->name('earnings');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->middleware('throttle:10,1')->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits');
    Route::post('/deposits/{deposit}/approve', [AdminDepositController::class, 'approve'])->middleware('throttle:30,1')->name('deposits.approve');
    Route::post('/deposits/{deposit}/reject', [AdminDepositController::class, 'reject'])->middleware('throttle:30,1')->name('deposits.reject');
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals');
    Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->middleware('throttle:30,1')->name('withdrawals.approve');
    Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->middleware('throttle:30,1')->name('withdrawals.reject');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{user}/referrals', [AdminUserController::class, 'referrals'])->name('users.referrals');
    Route::get('/rewards', [AdminRewardController::class, 'index'])->name('rewards');
    Route::post('/rewards', [AdminRewardController::class, 'store'])->middleware('throttle:20,1')->name('rewards.store');
    Route::get('/rewards/{reward}/receipt', [AdminRewardController::class, 'receipt'])->name('rewards.receipt');
    Route::get('/settings', [AdminSettingsController::class, 'show'])->name('settings');
    Route::post('/settings', [AdminSettingsController::class, 'update'])->middleware('throttle:20,1')->name('settings.update');
});
