<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('auth.login');
});
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('about', [DashboardController::class, 'about'])->name('about.index');
    Route::post('about', [DashboardController::class, 'about'])->name('about.create');
    Route::get('skills', [DashboardController::class, 'skills'])->name('skills.index');
    Route::post('skills', [DashboardController::class, 'skills'])->name('skills.create');
    Route::get('resume', [DashboardController::class, 'resume'])->name('resume.index');
    Route::post('resume', [DashboardController::class, 'resume'])->name('resume.create');
    Route::get('service', [DashboardController::class, 'service'])->name('service.index');
    Route::post('service', [DashboardController::class, 'service'])->name('service.create');
    Route::get('portfolio', [DashboardController::class, 'portfolio'])->name('portfolio.index');
    Route::post('portfolio', [DashboardController::class, 'portfolio'])->name('portfolio.create');
    Route::get('testimonial', [DashboardController::class, 'testimonial'])->name('testimonial.index');
    Route::post('testimonial', [DashboardController::class, 'testimonial'])->name('testimonial.create');
    Route::get('general-setting', [DashboardController::class, 'generalSettings'])->name('general-setting.index');
    Route::post('general-setting', [DashboardController::class, 'generalSettings'])->name('general-setting.create');
    Route::get('contacts', [DashboardController::class, 'contacts'])->name('contact.index');
    Route::post('contacts', [DashboardController::class, 'contacts'])->name('contact.create');
    Route::get('profile', [DashboardController::class, 'contacts'])->name('profile.index');
    Route::post('profile', [DashboardController::class, 'contacts'])->name('profile.create');
    Route::get('logout', [LogoutController::class, 'logout'])->name('auth.logout');
});
