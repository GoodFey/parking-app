<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

Route::get('/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');
//
Route::patch('/clients', [ClientController::class, 'update'])->name('clients.update');



