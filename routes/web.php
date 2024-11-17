<?php

use App\Http\Controllers\CommunityLinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityLinkUserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UserController;

Route::resource('users', UserController::class)
    ->middleware('can:administrate,App\Models\User');

// Ruta para mostrar un usuario específico
Route::get('users/{user}', [UserController::class, 'show'])->middleware(['auth', 'verified']);

// Ruta de recursos para la gestión de usuarios, protegida por middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::resource('banks', BankController::class)->middleware(['auth', 'verified']);

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['auth', 'verified']);

Route::get('/community-links', [CommunityLinkController::class, 'index'])->name('communityLinks.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CommunityLinkController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::get('/analitics', function () {
    return view('analitics');
})->middleware(['auth', 'verified'])->name('analitics');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/community-links', [CommunityLinkController::class, 'store'])->name('community-links.store')->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mylinks', [CommunityLinkController::class, 'myLinks'])->name('mylinks');
});

Route::get('dashboard/{channel:slug}', [CommunityLinkController::class, 'index']);

Route::post('/votes/{link}', [CommunityLinkUserController::class, 'store'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';