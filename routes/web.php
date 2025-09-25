<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AccountController;

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

// Fluxo de doação
Route::get('/doar', [DonationController::class, 'step1'])->middleware('auth')->name('donation');
Route::post('/doar/etapa1', [DonationController::class, 'processStep1'])->middleware('auth')->name('donation.step1');
Route::get('/doar/etapa2', [DonationController::class, 'step2'])->middleware('auth')->name('donation.step2');
Route::post('/doar/etapa2', [DonationController::class, 'processStep2'])->middleware('auth')->name('donation.step2.process');
Route::get('/doar/etapa3', [DonationController::class, 'step3'])->middleware('auth')->name('donation.step3');
Route::post('/doar/etapa3', [DonationController::class, 'processStep3'])->middleware('auth')->name('donation.step3.process');
Route::get('/doar/confirmacao', [DonationController::class, 'confirmation'])->middleware('auth')->name('donation.confirmation');
Route::post('/doar/finalizar', [DonationController::class, 'finalize'])->middleware('auth')->name('donation.finalize');
Route::get('/doar/sucesso/{id}', [DonationController::class, 'success'])->middleware('auth')->name('donation.success');

// Páginas do usuário
Route::get('/conta', [AccountController::class, 'index'])->middleware('auth')->name('account');
Route::get('/doacoes/status', [DonationController::class, 'status'])->middleware('auth')->name('donation.status');

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

// Página de contato
Route::get('/contato', function () {
    return view('contact');
})->name('contact');
