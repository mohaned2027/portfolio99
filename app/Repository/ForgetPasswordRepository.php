<?php

namespace App\Repository;

use App\Models\PasswordResetToken;
use App\Models\User;

class ForgetPasswordRepository
{
    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function saveResetToken(string $email, string $token, $expiresAt)
    {
        return PasswordResetToken::updateOrCreate(
            ['email' => $email],
            ['token' => $token, 'expires_at' => $expiresAt]
        );
    }

    public function getResetTokenByEmail(string $email)
    {
        return PasswordResetToken::where('email', $email)->first();
    }

    public function deleteResetTokenByEmail(string $email): int
    {
        return PasswordResetToken::where('email', $email)->delete();
    }
}
