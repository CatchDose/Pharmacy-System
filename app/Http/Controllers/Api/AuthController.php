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
    public function login(SanctumTokenRequest $request)
    {

        $user = User::where('email', $request->email)

            ->whereHas('roles', function ($role) {

                return $role->where('name', 'client');
            })->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->update([
            "last_login" => now()
        ]);

//        $user->createToken($request->device_name)->plainTextToken
        return new UserResource($user);
    }


    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile("avatar_image")) {
            $path = $request->file("avatar_image")
                ->store('', ["disk" => "avatars"]);

            $data["avatar_image"] = $path;
        }

        $user = User::create($data);
//        SendVerifyEmailJob::dispatch($user);
        $user->assignRole("client");

        $user->sendEmailVerificationNotificationApi();


        return new UserResource($user);
    }
}
