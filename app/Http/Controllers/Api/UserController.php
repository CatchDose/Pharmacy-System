<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request,User $user)
    {
        if(auth()->id() === $user->id){
            $user->update($request->validated());

            return response()->json([
                "message" => "User updated successfully",
                "data" => new UserResource($user)
            ],200);
        }

        return response()->json([
            "message" => "Sorry, You are not authorized to update user"
        ],403);
    }
}
