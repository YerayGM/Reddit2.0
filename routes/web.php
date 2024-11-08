<?php

use App\Http\Controllers\CommunityLinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityLinkUserController;
use App\Http\Controllers\VoteController;

Route::post('/community-links/{communityLinkId}/vote', [VoteController::class, 'store']);

Route::delete('/community-links/{communityLinkId}/vote', [VoteController::class, 'destroy']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CommunityLinkController::class, 'index'])
->middleware(middleware:['auth', 'verified'])
->name(name:'dashboard');

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

Route::post('/community-links', [CommunityLinkController::class, 'store'])->name('community-links.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mylinks', [CommunityLinkController::class, 'myLinks'])->name('mylinks');
});

Route::get('dashboard/{channel:slug}',[CommunityLinkController::class, 'index']);

Route::post('/votes/{link}', [CommunityLinkUserController::class, 'store']);

require __DIR__.'/auth.php';
