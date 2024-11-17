<?php

use App\Http\Controllers\CommunityLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommunityLinkUserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por autenticación y verificación
Route::middleware(['auth', 'verified'])->group(function () {
    // Rutas del perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard y enlaces comunitarios
    Route::get('/dashboard', [CommunityLinkController::class, 'index'])->name('dashboard');
    Route::get('dashboard/{channel:slug}', [CommunityLinkController::class, 'index']);

    // Gestión de enlaces
    Route::post('/community-links', [CommunityLinkController::class, 'store'])->name('community-links.store');
    Route::get('/community-links', [CommunityLinkController::class, 'index'])->name('communityLinks.index');
    Route::get('/mylinks', [CommunityLinkController::class, 'myLinks'])->name('mylinks');

    // Votar enlaces
    Route::post('/votes/{link}', [CommunityLinkUserController::class, 'store']);
});

// Gestión de usuarios solo para administradores
Route::resource('users', UserController::class)->middleware('can:administrate,App\Models\User');

// Gestión de bancos
Route::resource('banks', BankController::class)->middleware(['auth', 'verified']);

// Rutas adicionales
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/analitics', function () {
    return view('analitics');
})->name('analitics');

// Autenticación
require __DIR__.'/auth.php';
