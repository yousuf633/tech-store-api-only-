<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $user
        ], 201);
    }

  public function login(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = Auth::guard('api')->attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    return response()->json([
        'message' => 'success',
        'token' => $token,
        'user' => Auth::guard('api')->user()
    ]);
}

 public function logout()
{
    auth('api')->logout();

    return response()->json([
        'message' => 'Logged out successfully'
    ]);
}
}