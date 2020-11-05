<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('events', EventController::class);
Route::resource('members', MemberController::class);