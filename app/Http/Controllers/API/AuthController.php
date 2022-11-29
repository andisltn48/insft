<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'berhasil login',
                'token' => Auth::user()->createToken('BEARER-TOKEN')->plainTextToken;
            ],200);
        } else {
            return response()->json([
                'statusCode' => 401,
                'message' => 'email atau password salah',
            ],401);
        }
        
    }
}
