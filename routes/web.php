<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Doctor\MedicalInfoController;
// routes/web.php



Route::middleware(['auth'])->group(function () {

    // Rutas para el admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    });

    // Rutas para el doctor
    Route::middleware('role:doctor')->group(function () {
        Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.dashboard');
    });

    Route::prefix('doctor')->middleware(['auth', 'role:doctor'])->group(function () {
        Route::get('medical_infos/create', [MedicalInfoController::class, 'create'])->name('doctor.medical_infos.create');
        Route::post('medical_infos', [MedicalInfoController::class, 'store'])->name('doctor.medical_infos.store');
        Route::get('patients', [MedicalInfoController::class, 'index'])->name('doctor.patients.index');
    });

    // Rutas para el paciente
    Route::middleware('role:patient')->group(function () {
        Route::get('/patient', [PatientController::class, 'index'])->name('patient.dashboard');
        Route::get('/patient/medical_infos', [PatientController::class, 'medicalInfos'])->name('patient.medical_infos');
    });

    // Rutas para el perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ruta del dashboard, protegida por autenticación y verificación
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
