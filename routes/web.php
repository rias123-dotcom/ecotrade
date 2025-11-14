<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Trader\MessageController;
use App\Http\Controllers\TradeTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes (skeleton)
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Auth
Route::prefix('register')->group(function () {
    // Step 1
    Route::get('/', [AuthController::class, 'showRegisterStep1'])->name('register');
    Route::post('/step-1', [AuthController::class, 'postRegisterStep1'])->name('register.post');

    // Step 2
    Route::get('/step-2', [AuthController::class, 'showRegistrationStep2'])->name('register.step2');
    Route::post('/step-2', [AuthController::class, 'postRegisterStep2'])->name('register.step2.post');

    // Step 3
    Route::get('/step-3', [AuthController::class, 'showRegistrationStep3'])->name('register.step3');
    Route::post('/step-3', [AuthController::class, 'storeRegistration'])->name('register.step3.post');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Trades

Route::middleware(['auth:trader'])->group(function () {
    Route::get('/dashboard', [TradeController::class, 'dashboard'])->name('dashboard');

    Route::get('/trades/create', [TradeController::class, 'create'])->name('trades.create');
    Route::post('/trades', [TradeController::class, 'store'])->name('trades.store');
    Route::get('/trades', [TradeController::class, 'index'])->name('trades.index');
});

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/trades', [AdminController::class, 'trades'])->name('admin.trades');
});


Route::middleware('auth')->group(function () {
    Route::get('/trades/create', [TradeController::class, 'create'])->name('trades.create');
    Route::post('/trades', [TradeController::class, 'store'])->name('trades.store');
    Route::get('/trades', [TradeController::class, 'index'])->name('trades.index');
});

// Admin (protected by simple RoleMiddleware 'admin')
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/trades', [AdminController::class, 'trades'])->name('admin.trades');


    //Encrypted Message
    Route::middleware(['auth'])->prefix('trader')->group(function () {
        Route::get('/messages', [MessageController::class, 'index'])->name('trader.messages');
        Route::post('/messages/send', [MessageController::class, 'send'])->name('trader.messages.send');
        Route::get('/messages/conversation/{partnerId}', [MessageController::class, 'conversation'])
            ->name('trader.messages.conversation');
    });
    

    //Trade Transaction
    Route::get('/trades', [TradeTransactionController::class, 'index'])->name('trades.index');
    Route::post('/trades', [TradeTransactionController::class, 'store'])->name('trades.store');
});
