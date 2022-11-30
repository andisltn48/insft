<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Services\UserService;


class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email','password']);

        try {
            $authenticate = $this->userService->authenticate($credentials);
            if ($authenticate) {
                $response['status'] = 200;
                $response['message'] = 'berhasil login';
                $response['data'] = $authenticate;
                
            } else {
                $response['status'] = 401;
                $response['message'] = 'email atau password salah';
            }
            
        } catch (Exception $e) {
            $response = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($response,$response['status']);
        
    }
}
