<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminRewardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BusinessPlanController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/plans', [PlanController::class, 'index'])->name('plans');
Route::get('/earning-details', [EarningController::class, 'index'])->name('earning-details');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/business-plan', [BusinessPlanController::class, 'index'])->name('business-plan');

// Auth Routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');
    
    Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Dashboard Routes (authenticated + email verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/deposit', [DepositController::class, 'show'])->name('deposit');
    Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.store');
    Route::get('/deposits/{deposit}/receipt', [DepositController::class, 'receipt'])->name('deposits.receipt');
    Route::get('/withdraw', [WithdrawController::class, 'show'])->name('withdraw');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');
    Route::get('/withdrawals/{withdrawal}/receipt', [WithdrawController::class, 'receipt'])->name('withdrawals.receipt');
    Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals');
    Route::get('/earnings', [EarningController::class, 'earnings'])->name('earnings');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits');
    Route::post('/deposits/{deposit}/approve', [AdminDepositController::class, 'approve'])->name('deposits.approve');
    Route::post('/deposits/{deposit}/reject', [AdminDepositController::class, 'reject'])->name('deposits.reject');
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals');
    Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
    Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{user}/referrals', [AdminUserController::class, 'referrals'])->name('users.referrals');
    Route::get('/rewards', [AdminRewardController::class, 'index'])->name('rewards');
    Route::post('/rewards', [AdminRewardController::class, 'store'])->name('rewards.store');
    Route::get('/rewards/{reward}/receipt', [AdminRewardController::class, 'receipt'])->name('rewards.receipt');
    Route::get('/settings', [AdminSettingsController::class, 'show'])->name('settings');
    Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
});
