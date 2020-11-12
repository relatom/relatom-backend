<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'current']);

	Route::resource('events', EventController::class);
	Route::get('/events/{event}/comments', [EventController::class, 'getComments']);
	Route::post('/events/{event}/comments', [EventController::class, 'storeComment']);

	Route::get('/events/{event}/participants', [EventController::class, 'getParticipants']);

	Route::get('/events/{event}/participations', [EventController::class, 'getParticipations']);
	Route::post('/events/{event}/participations', [EventController::class, 'storeParticipations']);

});
