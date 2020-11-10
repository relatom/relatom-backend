<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
    	return $request->user();
	});

    Route::post('/logout', [AuthController::class, 'logout']);

	Route::resource('events', EventController::class);
	Route::get('/events/{event}/comments', [EventController::class, 'getComments']);
	Route::post('/events/{event}/comments', [EventController::class, 'storeComment']);


	Route::resource('members', MemberController::class);

});
