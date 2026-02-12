<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Ubah auth() jadi auth()->guard('api')
        $token = auth()->guard('api')->login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token
        ]);
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Ubah auth() jadi auth()->guard('api')
        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    // Check Token (Me)
    public function me()
    {
        // Ubah auth() jadi auth()->guard('api')
        return response()->json(auth()->guard('api')->user());
    }

    // Logout
    public function logout()
    {
        // Ubah auth() jadi auth()->guard('api')
        auth()->guard('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Helper
    protected function respondWithToken($token)
    {
        // Ubah auth() jadi auth()->guard('api')
        // factory() ini cuma ada di JWT, kalau ga pake guard('api') pasti error
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }
}