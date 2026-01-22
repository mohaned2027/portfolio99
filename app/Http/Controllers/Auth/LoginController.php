<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;

class LoginController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function login(UserRequest $request)
    {
        $data = $request->validated();
        $token = $this->userService->login($data);

        if (!$token) {
            return apiResponce(401, 'Invalid Credentials');
        }

        return apiResponce(200, 'Success', ['token' => $token]);
    }

    public function logout(){
        $this->userService->logout();
        return apiResponce(200, 'Success');
    }
}
