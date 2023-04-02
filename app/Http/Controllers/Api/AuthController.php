<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Requests\Api\SanctumTokenRequest;
use App\Http\Resources\UserResource;
use App\Jobs\SendVerifyEmailJob;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function getToken(SanctumTokenRequest $request)
    {

        $user = User::where('email', $request->email)

                ->whereHas('roles',function($role){

                    return $role->where('name','client');

                })->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->update([
            "last_login" => now()
        ]);


        return $user->createToken($request->device_name)->plainTextToken;

    }


    public function register(RegisterUserRequest $request)
    {
        $user = User::create($request->validated());
//        SendVerifyEmailJob::dispatch($user);
//        event(new Registered($user));

        $user->assignRole("client");
        return new UserResource($user);
    }


}

