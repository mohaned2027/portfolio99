<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;

class RegisterController extends Controller
{
    public function register(UserRequest $userRequest)
    {
        $data = $userRequest->validated();

        // Registration logic here

        $user = User::create($data);

        $token = $user->createToken('user_token', [] , now()->addMinutes(60))->plainTextToken;

        return apiResponce(201 , 'Success Registration' , ['token' => $token]);


    }
}
