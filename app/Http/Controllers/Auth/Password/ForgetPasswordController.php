<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Services\ForgetPasswordServices;

class ForgetPasswordController extends Controller
{
    public function __construct(protected ForgetPasswordServices $forgetPasswordServices) {}

    public function send(ForgetPasswordRequest $request)
    {
        $data = $request->validated();

        $sent = $this->forgetPasswordServices->sendOtp($data['email']);
        if (! $sent) {
            return apiResponce(404, 'User not found');
        }

        return apiResponce(200, 'OTP sent successfully');

    }
}
