<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\ForgetPasswordServices;

class ResetPasswordController extends Controller
{
    public function __construct(protected ForgetPasswordServices $forgetPasswordServices) {}

    public function reset(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $result = $this->forgetPasswordServices->resetPassword($data);
        if (! $result['ok']) {
            if ($result['message'] === 'User not found') {
                return apiResponce(404, 'User not found');
            }

            return apiResponce(422, $result['message']);
        }

        return apiResponce(200, 'Password reset successfully');
    }
}
