<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autnticação e registro
Route::get('register', [UserController::class, 'create'])->name('register');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('logout');
Route::post('logout/{id}', [AuthController::class, 'destroy'])->name('logout');
Route::resource('users', UserController::class);
Route::get('profile/{slug}', [UserController::class, 'show'])->name('profile');

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('links', LinkController::class);
    }
);
