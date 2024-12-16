<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
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


// Auth
Route::get('/', [AuthController::class, 'showLoginForm'])->name('auth.loginForm');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Routes untuk Guru
Route::middleware(['guru'])->group(function () {
    // dashboard
    Route::get('/about', [AuthController::class, 'about'])->name('about');
    Route::get('/dashboard-guru', [DashboardController::class, 'dashboardGuru'])->name('dashboardGuru.index');
    Route::get('/dashboard-guru/edit', [DashboardController::class, 'dashboardGuruEdit'])->name('dashboardGuru.edit');
    Route::patch('/dashboard-guru', [DashboardController::class, 'dashboardGuruUpdate'])->name('dashboardGuru.update');

    // profile
    Route::get('/users/profile', [UserController::class, 'profile'])->name('user.profile');

    // Schedules
    Route::get('/users/schedules', [ScheduleController::class, 'scheduleUser'])->name('scheduleUser.index');

    //absences
    Route::get('/users/absences', [AbsenceController::class, 'userAbsence'])->name('absence.userAbsence');
    Route::get('/users/absences/scan-qr', [AbsenceController::class, 'scanQR'])->name('absence.scanQR');
    Route::get('/users/absences/{class_name}', [AbsenceController::class, 'absence'])->name('absence.absence');
    Route::post('/users/absences/{class_name}', [AbsenceController::class, 'store'])->name('absence.store');
});

// Routes untuk Admin
Route::middleware(['admin'])->group(function () {
    // dashboard
    Route::get('/dashboard/dashboardadmin', [AuthController::class, 'dashboardadmin'])->name('dashboardadmin');
    Route::get('/about', [AuthController::class, 'about'])->name('about');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // class
    Route::get('/classes/create', [ClassController::class, 'create'])->name('class.create');
    Route::get('/classes', [ClassController::class, 'index'])->name('class.index');
    Route::get('/classes/{id}', [ClassController::class, 'show'])->name('class.show');
    Route::get('/classes/{id}/download-qr-code', [ClassController::class, 'downloadQrCode'])->name('class.downloadQrCode');
    Route::post('/classes', [ClassController::class, 'store'])->name('class.store');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('class.edit');
    Route::patch('/classes/{id}', [ClassController::class, 'update'])->name('class.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('class.destroy');

    // Abcences
    Route::get('/absences', [AbsenceController::class, 'index'])->name('absence.index');
    Route::get('/absences/{id}/edit', [AbsenceController::class, 'edit'])->name('absence.edit');
    Route::patch('/absences/{id}', [AbsenceController::class, 'update'])->name('absence.update');

    // Schedules
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::patch('/schedules/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
});
