<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function getUserByEmail($data)
    {
        return User::where('email', $data['email'])->first();
    }

    public function deleteUserToken($user){
        return $user->currentAccessToken()->delete();
    }


}
