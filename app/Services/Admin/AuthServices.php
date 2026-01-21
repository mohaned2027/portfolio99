<?php

namespace App\Services\Admin;

use App\Repository\Admin\AuthRepository;

class AuthServices
{
    /**
     * Create a new class instance.
     */
    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function login($credentials, $admin, $remember = false)
    {
        return  $this->authRepository->login($credentials, $admin, $remember);
    }

    public function logout($admin)
    {
        return $this->authRepository->logout($admin);
    }
}
