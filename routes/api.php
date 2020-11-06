<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', function( ){
    $email = Request::get('email');
    $password = Request::get('password');
    

    if (Auth::attempt([
        'email' => $email,
        'password' => $password
    ])) {
        return response()->json('', 204 );
    }else{
        return response()->json([
            'error' => 'invalid_credentials'
        ], 403);
    }
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('events', EventController::class);
Route::resource('members', MemberController::class);