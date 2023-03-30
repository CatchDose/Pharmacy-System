<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $pharmacies = Pharmacy::all();
        return view("profiles.edit",["pharmacies" => $pharmacies]);
    }

    public function update(UpdateProfileRequest $request,User $profile)
    {
        $data = $request->validated();

        $data["password"] = isset($request->password)
            ? Hash::make($request->password)
            : $profile->password;

        if ($request->hasFile("avatar_image"))
        {
            Storage::disk("avatars")->delete($profile->avatar_image);
            $data["avatar_image"] = $request->file("avatar_image")
                ->store('',["disk"=>"avatars"]);
        }

        $profile->update($data);

        return redirect()->route("index");
    }
}
