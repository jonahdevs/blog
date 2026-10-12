<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

// Public Homepage & Viewing Routes
Route::get('/', [BlogController::class, 'home'])->name('home');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

// Authentication Routes
Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'handleLogin')->name('login.submit');
    Route::get('/register', 'registerForm')->name('register');
    Route::post('/register', 'handleRegister')->name('register.submit');
    Route::match(['post', 'delete'], '/logout', 'logout')->name('logout');
});

// Protected Dashboard & CRUD Routes (Requires Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BlogController::class, 'index'])->name('dashboard');
    
    // Changed path from /blogs/my-blogs to /my-blogs to prevent route collision
    Route::get('/my-blogs', [BlogController::class, 'userBlogs'])->name('blogs.user.list');
    
    // Resource routes (store, edit, update, destroy)
    Route::resource('blogs', BlogController::class)->except(['index', 'show']);
});