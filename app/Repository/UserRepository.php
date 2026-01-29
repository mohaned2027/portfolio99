<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function getUserByEmail($data)
    {
        return User::where('email', $data['email'])->first();
    }

    public function getUserData(){
        return User::first();
    }

    public function deleteUserToken($user)
    {
        return $user->currentAccessToken()->delete();
    }

    public function update(User $user, array $data)
    {
        return $user->update($data);
    }
}
