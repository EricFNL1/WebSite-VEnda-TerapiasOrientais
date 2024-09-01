<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/agendamentos', [PageController::class, 'agendamentos'])->name('agendamentos');