<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected UserService $userService) {}

    public function index()
    {
        $user = $this->userService->getUserAuth();
        if (! $user) {
            return apiResponce(401, 'Unauthorize');
        }

        return apiResponce(200, 'Success', new UserResource($user));
    }

    public function getUserData(){
        $user = $this->userService->getUserData();
        return apiResponce(200, 'Success', new UserResource($user));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        $data = $request->validated();

        if (! $data) {
            return apiResponce(400, 'Bad Request');
        }

        $user = $this->userService->update($data);
        if (! $user) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success', new UserResource($user));
    }



    /**
     * Remove the specified resource from storage.
     */
}
