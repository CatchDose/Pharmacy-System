<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Utilities\Request;

class AuthController extends Controller
{
    public function gettoken(Request $request){
        
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'required',
            ]);
        
            $user = User::where('email', $request->email)->first();
            // dd($user);
        
            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
        
            return $user->createToken($request->device_name)->plainTextToken;
        
        }
    
    }

