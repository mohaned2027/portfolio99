<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\OtpRequest;
use App\Services\ForgetPasswordServices;

class OtpController extends Controller
{
    public function __construct(protected ForgetPasswordServices $forgetPasswordServices) {}

    public function verify(OtpRequest $request)
    {
        $data = $request->validated();

        $result = $this->forgetPasswordServices->verifyOtp($data);
        if (! $result['ok']) {
            if ($result['message'] === 'User not found') {
                return apiResponce(404, 'User not found');
            }

            return apiResponce(422, $result['message']);
        }

        return apiResponce(200, 'OTP verified', ['reset_token' => $result['token']]);
    }
}
