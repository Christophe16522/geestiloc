<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('properties',   PropertyController::class);
    Route::resource('tenants',      TenantController::class);
    Route::resource('contracts',    ContractController::class);
    Route::resource('payments',     PaymentController::class);
    Route::resource('documents',    DocumentController::class)->except(['edit', 'update']);
    Route::resource('maintenances', MaintenanceController::class);

    // Actions spéciales
    Route::patch('payments/{payment}/mark-paid',        [PaymentController::class,    'markAsPaid'])->name('payments.markPaid');
    Route::patch('contracts/{contract}/archive',        [ContractController::class,   'archive'])->name('contracts.archive');
    Route::patch('maintenances/{maintenance}/progress', [MaintenanceController::class,'updateProgress'])->name('maintenances.progress');

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Profile
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google OAuth
Route::get('auth/google',          [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

require __DIR__.'/auth.php';
