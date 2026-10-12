<?php

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'handleLogin')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'registerForm')->name('register');
    Route::post('/register', 'handleRegister')->name('register.submit');
    Route::delete('/logout', 'logout')->name('logout');

    route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth')->name('dashboard');
});
