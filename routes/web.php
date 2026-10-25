<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

// Rute tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute yang memerlukan login
Route::middleware('auth')->group(function () {

    // Dashboard user biasa
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fitur pengaduan untuk user
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

    // Rute khusus admin
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Kelola user
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // <-- Route Baru
        Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Kelola pengaduan
        Route::get('/complaints', [ComplaintController::class, 'adminIndex'])->name('complaints.index');
        Route::get('/complaints/{complaint}', [ComplaintController::class, 'adminShow'])->name('complaints.show');
        Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Redirect halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});