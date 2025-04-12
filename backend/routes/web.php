<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;



Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');

// Route::post('registrationUser', [UserController::class, 'registrationUser'])->name('registrationUser');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');