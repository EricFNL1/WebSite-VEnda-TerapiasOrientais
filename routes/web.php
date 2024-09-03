<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('index');
})->name('index'); // Nomeie a rota como 'index'

Route::get('/agendamentos', [PageController::class, 'agendamentos'])->name('agendamentos');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});

// Rotas para o painel do usuário
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas para o painel do administrador
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // Outras rotas de administração
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin_dashboard');
    Route::post('/admin/update-images', [AdminController::class, 'updateImages'])->name('admin.updateImages');
    // Outras rotas de administração
});

Route::post('/admin/update-background-image', [AdminController::class, 'updateBackgroundImage'])->name('admin.updateBackgroundImage');
Route::patch('/appointments/{appointment}/update-time', [AppointmentController::class, 'updateTime'])->name('appointments.updateTime');
Route::post('/admin/update-carousel-images', [AdminController::class, 'updateCarouselImages'])->name('admin.updateCarouselImages');
Route::post('/admin/remove-carousel-image', [AdminController::class, 'removeCarouselImage'])->name('admin.removeCarouselImage');


