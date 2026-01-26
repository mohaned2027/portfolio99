<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected ImageManager $imageManager
    ) {}

    public function login($data)
    {
        $user = $this->userRepository->getUserByEmail($data);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
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
        if (! $user) {
            return false;
        }

        return $user;
        // return auth()->user() ;
        // Auth::guard('auth:sanctum')->user();

    }

    public function update($data)
    {
        $user = $this->getUserAuth();
        if (! $user) {
            return false;
        }

        if (isset($data['avatar'])) {
            $data['avatar'] = $this->imageManager->uploadSingleImage(
                $data['avatar'],
                'users',
                'store',
                $user->avatar
            );
            if (! $data['avatar']) {
                return false;
            }
        }

        if (array_key_exists('password', $data) && ! $data['password']) {
            unset($data['password']);
        }

        if (! $this->userRepository->update($user, $data)) {
            return false;
        }

        return $user->fresh();
    }

    public function checkEmail($email)
    {
        $user = $this->userRepository->getUserByEmail($email);
        if (! $user) {
            return false;
        }

        return $user;
    }
}
