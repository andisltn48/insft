<?php

namespace App\Services;

use Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService {
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository  = $userRepository;
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
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
        if (Auth::attempt($credentials)) {
            dd(Auth::user()->createToken('Bearer'));
            return ['token' => Auth::user()->createToken('Bearer-token')->plainTextToken];
        } else {
            return null;
        }

    }
}