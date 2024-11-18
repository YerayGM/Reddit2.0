<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CommunityLinkController;

Route::apiResource('v1/communitylinks', CommunityLinkController::class)->middleware('auth:sanctum');

Route::apiResource('v1/communitylink', CommunityLinkController::class)
->middleware(['verified', 'auth:sanctum']);

// Rutas de la API para CommunityLinks (versión 1)
Route::prefix('v1')->group(function () {
    Route::apiResource('communitylinks', CommunityLinkController::class);
});
