<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json('', 200);
        } else {
            return response()->json('', 422);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
    }
}
