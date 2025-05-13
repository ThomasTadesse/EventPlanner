<?php

use Illuminate\Support\Facades\Route;

// Include test routes
include __DIR__ . '/T_web.php';

// Define main routes
Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
