<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;

Route::get('/', [IndexController::class, 'show'])->name('index');

Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
