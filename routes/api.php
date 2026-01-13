<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// Public routes
Route::apiResource('events', EventController::class)
    ->only(['index']);

// Protected routes
Route::apiResource('events', EventController::class)
    ->only(['store', 'update', 'destroy','show'])
    ->middleware(['auth:sanctum', 'throttle:api']);

Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::apiResource('events.attendees', AttendeeController::class)
        ->scoped()
        ->only(['index','store', 'destroy', 'show']);
});

