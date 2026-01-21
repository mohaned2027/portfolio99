<?php

namespace App\Repository\Admin;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * Create a new class instance.
     */
    public function login($credentials, $admin, $remember = false)
    {
        return  Auth::guard($admin)->attempt($credentials, $remember);
    }

    public function logout($admin)
    {
        Auth::guard($admin)->logout();
    }
}
