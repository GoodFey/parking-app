<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('/clients/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');

Route::patch('/clients/edit/{client}', [ClientController::class, 'update'])->name('clients.update');

Route::patch('/cars/edit/{car}', [CarController::class, 'update'])->name('cars.update');

Route::post('/cars/{car}', [CarController::class, 'store'])->name('cars.store');





