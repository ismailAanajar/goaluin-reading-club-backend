<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
     public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // return $credentials;
        if (Auth::attempt($credentials)) {
            $user = $request->user();
           
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request)
    {
        
        // $token = Str::random(32);
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'a verification code  has send to your email'
        ]);
    }

    public function profile()
    {
        $user = Auth::user();

        return response()->json([
            'userInfo' => [
                'name' => $user->name, 
            'email' => $user->email,
            'posts' => $user->posts 
            ]
        ]);
    }
}