<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return Inertia::render('Home');
    })->name('home');

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
    ], function () {
        Route::resource('/vehicle', VehicleController::class);
        Route::put('/vehicle/{id}/{status}', [VehicleController::class, 'updateStatus'])->name('vehicle.update-status');
    });
});
