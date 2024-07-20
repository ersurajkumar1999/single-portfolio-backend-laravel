<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OpenAIController;
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

    //  About section
    Route::get('about', [DashboardController::class, 'about'])->name('about.index');
    Route::post('about', [DashboardController::class, 'aboutUpdate'])->name('about.create');
    Route::post('about-item-create', [DashboardController::class, 'aboutItemCreate'])->name('about.item.create');
    Route::post('about-item-delete', [DashboardController::class, 'aboutItemDelete'])->name('about.item.delete');
    


    Route::get('skills', [DashboardController::class, 'skills'])->name('skills.index');
    Route::post('skills', [DashboardController::class, 'skillUpdate'])->name('skills.create');
    Route::post('skill-item-create', [DashboardController::class, 'skillItemCreate'])->name('skill.item.create');
    Route::post('skill-item-delete', [DashboardController::class, 'skillItemDelete'])->name('skill.item.delete');
    
    Route::get('resume', [DashboardController::class, 'resume'])->name('resume.index');
    Route::post('resume', [DashboardController::class, 'resume'])->name('resume.create');
    
    Route::get('service', [DashboardController::class, 'service'])->name('service.index');
    Route::post('service', [DashboardController::class, 'serviceUpdate'])->name('service.create');
    Route::post('service-item-create', [DashboardController::class, 'serviceItemCreate'])->name('service.item.create');
    Route::post('service-item-delete', [DashboardController::class, 'serviceItemDelete'])->name('service.item.delete');
    
    Route::get('portfolio', [DashboardController::class, 'portfolio'])->name('portfolio.index');
    Route::post('portfolio', [DashboardController::class, 'portfolioUpdate'])->name('portfolio.create');
    Route::post('portfolio-item-create', [DashboardController::class, 'portfolioItemCreate'])->name('portfolio.item.create');
    Route::post('portfolio-item-delete', [DashboardController::class, 'portfolioItemDelete'])->name('portfolio.item.delete');

    Route::get('project', [DashboardController::class, 'project'])->name('project.index');
    Route::post('project', [DashboardController::class, 'projectUpdate'])->name('project.create');
    Route::post('project-item-create', [DashboardController::class, 'projectItemCreate'])->name('project.item.create');
    Route::post('project-item-delete', [DashboardController::class, 'projectItemDelete'])->name('project.item.delete');
    
    Route::get('testimonial', [DashboardController::class, 'testimonial'])->name('testimonial.index');
    Route::post('testimonial', [DashboardController::class, 'testimonial'])->name('testimonial.create');
    
    Route::get('general-setting', [DashboardController::class, 'generalSettings'])->name('general-setting.index');
    Route::post('general-setting', [DashboardController::class, 'generalSettings'])->name('general-setting.create');
    
    Route::get('contacts', [DashboardController::class, 'contacts'])->name('contact.index');
    Route::post('contacts', [DashboardController::class, 'contacts'])->name('contact.create');
    
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile.index');
    Route::post('profile', [DashboardController::class, 'profile'])->name('profile.create');

    Route::get('open-ai', [OpenAIController::class, 'index'])->name('open-ai.index');
    
    Route::get('logout', [LogoutController::class, 'logout'])->name('auth.logout');
});
