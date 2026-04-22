<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PlatformController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('developers', DeveloperController::class)->except(['show', 'create']);
    Route::resource('genres', GenreController::class)->except(['show', 'create']);
    Route::resource('platforms', PlatformController::class)->except(['show', 'create']);
    Route::resource('games', GameController::class)->except(['show', 'create']);

    Route::get('/collection', [CollectionController::class, 'index'])->name('collection.index');
    Route::post('/collection', [CollectionController::class, 'store'])->name('collection.store');
    Route::put('/collection/{gameId}', [CollectionController::class, 'update'])->name('collection.update');
    Route::delete('/collection/{gameId}', [CollectionController::class, 'destroy'])->name('collection.destroy');
});
