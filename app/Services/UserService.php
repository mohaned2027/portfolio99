<?php

namespace App\Services;

use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{


    public function __construct(protected UserRepository $userRepository) {}


    public function login($data)
    {
        $user =  $this->userRepository->getUserByEmail($data);


        if (!$user || !Hash::check($data['password'], $user->password)) {
            return false;
        }
        $token = $user->createToken('admin_token', [], now()->addMinutes(60))->plainTextToken;

        return $token;
    }

    public function logout()
    {
        $user = $this->getUserAuth();

        return $this->userRepository->deleteUserToken($user);
    }

    public function getUserAuth()
    {
        $user = request()->user();
        if (!$user) {
            return false;
        }
        return $user;
        // return auth()->user() ;
        // Auth::guard('auth:sanctum')->user();

    }
}
