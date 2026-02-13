<?php

use Inertia\Inertia;


use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/invoke-agent', [AgentController::class, 'callAgent'])->name('invoke-agent')->middleware('auth');




require __DIR__ . '/settings.php';
