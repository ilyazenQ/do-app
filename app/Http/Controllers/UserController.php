<?php

namespace App\Http\Controllers;

use App\Actions\Auth\UpdateUserPassword;
use App\Actions\User\UpdateUserPasswordAction;
use App\Actions\User\UpdateUserProfileAction;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function updateUserProfile(
        UpdateUserProfileRequest $request,
        UpdateUserProfileAction $action): UserResource
    {
        return new UserResource($action->execute($request->validated()));
    }

    public function updateUserPassword(
        UpdateUserPasswordRequest $request,
        UpdateUserPasswordAction $action): UserResource
    {
        return new UserResource($action->execute($request->validated()));
    }

    public function show(int $id)
    {
        return new UserResource(User::where('id', $id)->firstOrFail());
    }
}
