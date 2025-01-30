<?php

use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('home');
})->name('home');

// Login routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login.get');

Route::post('/login', [LoginController::class, 'login'])->name('login');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout route
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard routes
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            // OAuth Client management
            Route::resource('clients', ClientsController::class)
                ->only(['index', 'store', 'destroy']);
        });
});
