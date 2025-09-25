<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/debug', function () {
    return view('debug');
})->name('debug');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');

// Dashboard protegido
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Formulário de doação (apenas para usuários logados)
Route::get('/doar', function () {
    return view('donation');
})->middleware('auth')->name('donation');

Route::get('/doar-simple', function () {
    return view('donation-simple');
})->name('donation-simple');

Route::get('/responsive-test', function () {
    return view('responsive-test');
})->name('responsive-test');

Route::get('/hamburger-test', function () {
    return view('hamburger-test');
})->name('hamburger-test');

// Página de prioridades
Route::get('/prioridades', function () {
    return view('priorities');
})->name('priorities');
