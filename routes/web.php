<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CarController::class, 'index'])->name('cars.index');

Route::get('/cars/onParking/{client}', [CarController::class, 'onParking'])->name('cars.onParking');

Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('/clients/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');

Route::patch('/clients/edit/{client}', [ClientController::class, 'update'])->name('clients.update');

Route::delete('/clients/delete/{client}', [ClientController::class, 'delete'])->name('clients.delete');

Route::patch('/cars/edit/{car}', [CarController::class, 'update'])->name('cars.update');

Route::post('/cars/{car}', [CarController::class, 'store'])->name('cars.store');

Route::delete('/cars/delete/{car}', [CarController::class, 'delete'])->name('cars.delete');

Route::patch('cars/onParking/{car}', [CarController::class, 'removeFromParking'])
    ->name('cars.removeFromParking');

Route::patch('/cars/onParkingAdd/{car}', [CarController::class, 'updateParkingStatus'])
    ->name('cars.updateParkingStatus');





