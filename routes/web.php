<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\VehicleController;
use App\Http\Middleware\EnsureIsAdmin;
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

    Route::get('/home', [PageController::class, 'home'])->name('home');

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
    ], function () {
        Route::resource('/vehicles', VehicleController::class);
        Route::put('/vehicles/{id}/{status}', [VehicleController::class, 'updateStatus'])->name('vehicles.update-status');
    })->middleware(EnsureIsAdmin::class);
});
