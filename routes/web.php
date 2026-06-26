<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(EnsureAdmin::class)->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('admin.certificates.store');
    Route::delete('/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');
    Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
