<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (! Auth::check()) {
        return Inertia::render('Auth/Login', [
            'laravelVersion' => Application::VERSION,
            'phpVersion'     => PHP_VERSION,
        ]);
    }

    return Redirect::route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class)->except('destroy')->except(['show', 'destroy']);

    Route::put('/products/update-quantity', [ProductController::class, 'updateQuantity'])->name('products.update-quantity');
    Route::get('/products-table/{slug?}', [ProductController::class, 'index'])->name('products.table');
    Route::post('/products/add-to-project', [ProductController::class, 'addToProject'])->name('products.add-to-project');
    Route::resource('products', ProductController::class);

    Route::delete('/projects/destroy-product', [ProjectController::class, 'destroyProduct'])->name('projects.destroy-product');
    Route::get('/projects-table/{slug?}', [ProjectController::class, 'index'])->name('projects.table');
    Route::resource('projects', ProjectController::class);

    Route::resource('reports', ReportController::class)->except(['edit', 'update']);

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::put('/notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');
});

require __DIR__ . '/auth.php';
