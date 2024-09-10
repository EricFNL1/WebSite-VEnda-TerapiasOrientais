<?php

use App\Http\Controllers\FinancialController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialProjection;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('index');
})->name('index');

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
    Route::patch('/appointments/{appointment}/update-time', [AppointmentController::class, 'updateTime'])->name('appointments.updateTime');
    Route::patch('appointments/{appointment}/finalize', [AppointmentController::class, 'finalize'])->name('appointments.finalize');
});

// Rotas para o painel do administrador
// Rotas para o painel do administrador
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin_dashboard'); // Nome correto da rota
    Route::post('/admin/update-images', [AdminController::class, 'updateImages'])->name('admin.updateImages');
    Route::post('/admin/update-background-image', [AdminController::class, 'updateBackgroundImage'])->name('admin.updateBackgroundImage');
    Route::post('/admin/update-carousel-image', [AdminController::class, 'updateCarouselImage'])->name('admin.updateCarouselImage');
    Route::post('/admin/remove-carousel-image', [AdminController::class, 'removeCarouselImage'])->name('admin.removeCarouselImage');
   Route::patch('/admin/services/{id}/update-value', [AdminController::class, 'updateServiceValue'])->name('admin.service.updateValue');
   Route::delete('/admin/service/{id}/remove', [AdminController::class, 'removeService'])->name('admin.removeService');
   Route::post('/admin/add-service', [AdminController::class, 'addService'])->name('admin.addService');

});

Route::get('/financial', [FinancialController::class, 'index'])->name('financial.index');
Route::get('/financial', [FinancialController::class, 'index'])->name('financial.index');




Route::get('/generate-excel', [ReportController::class, 'generateExcelReport'])->name('generate.excel');
Route::get('/generate-pdf', [ReportController::class, 'generatePDFReport'])->name('generate.pdf');
