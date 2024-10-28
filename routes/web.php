<?php

use App\Http\Controllers\AdoptionApplicationController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ad;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

////////////////////////////////////////////////////////////pets page/////////////////////////////////////////////////////////

Route::get('/pet', [PetController::class, 'index'])->middleware(['auth', 'verified'])->name('pet');

Route::get('/pets/create', function () {
    return Inertia::render('Pet/create');
})->middleware(['auth', 'verified'])->name('create');

Route::post('/pets/create', [PetController::class, 'save'])->middleware(['auth', 'verified'])->name('pets.create');

Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');

Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->middleware(['auth', 'verified'])->name('pets.edit');

Route::post('/pets/edit/{id}', [PetController::class, 'update'])->name('pets.edit');

Route::delete('/pets/{id}', [PetController::class, 'destroy'])->middleware(['auth', 'verified'])->name('pets.destroy');

Route::get('/adoption/applyForm/{id}', [PetController::class, 'showForm'])->name('adoption.applyForm');

/////////////////////////////////////////////////////////////form page/////////////////////////////////////////////////////////////////

Route::post('/adoption/create', [AdoptionApplicationController::class, 'create'])->name('adoption.create');

Route::get('/adoptiondetails', [AdoptionApplicationController::class, 'index'])->middleware(['auth', 'verified'])->name('adoptiondetails');

Route::get('/adoption/{id}', [AdoptionApplicationController::class, 'show'])->name('adoption.show');

Route::patch('/adoption/{id}', [AdoptionApplicationController::class, 'update'])->name('adoption.edit');


require __DIR__.'/auth.php';
