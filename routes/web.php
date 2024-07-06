<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PatientController;
use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Auth\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('register/patient', [PatientController::class, 'create'])->name('register.patient');
Route::post('register/patient', [PatientController::class, 'store']);

Route::get('register/doctor', [DoctorController::class, 'create'])->name('register.doctor');
Route::post('register/doctor', [DoctorController::class, 'store']);

Route::get('register/admin', [AdminController::class, 'create'])->name('register.admin');
Route::post('register/admin', [AdminController::class, 'store']);

require __DIR__.'/auth.php';
