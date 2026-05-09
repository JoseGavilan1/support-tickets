<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Tickets\Index;
use App\Livewire\Tickets\Show;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- RUTAS DE LOS TICKETS ---
Route::get('/tickets', Index::class)->middleware(['auth', 'verified'])->name('tickets.index');
Route::get('/tickets/{ticket}', Show::class)->middleware(['auth', 'verified'])->name('tickets.show');
// ----------------------------

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
