<?php

namespace App\Services;


use JWTAuth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService {
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository  = $userRepository;
    }

    public function findByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    public function authenticate($credentials)
    {
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        if (!$jwtToken = JWTAuth::attempt($credentials)) {
            return null;
        }
        
        return [
            'token_type' => 'Bearer',
            'token' => $jwtToken,
        ];

    }

    public function logout()
    {
        JWTAuth::parseToken()->invalidate(true);
        return response()->json([
            'status' => 200,
            'message' => 'logout berhasil',
        ],200);
    }
}