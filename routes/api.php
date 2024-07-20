<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('profile', [UserController::class, 'index']);

Route::get('about', [UserController::class, 'about']);
Route::get('skills', [UserController::class, 'skills']);
Route::get('resume', [UserController::class, 'resume']);
Route::get('service', [UserController::class, 'service']);
Route::get('portfolio', [UserController::class, 'portfolio']);
Route::get('project', [UserController::class, 'project']);
Route::get('testimonial', [UserController::class, 'testimonial']);
Route::get('general-settings', [UserController::class, 'generalSettings']);

Route::post('contact/create', [UserController::class, 'contactCreate']);
