<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_mobile' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $credentials = $request->only('password');
        $user = User::where('email', $request->email_or_mobile)
            ->orWhere('phone_number', $request->email_or_mobile)
            ->first();
        if ($user->status !== 'active') {
            return response()->json(['message' => 'Account is not active'], 403);
        }
        if ($user && Auth::attempt(['email' => $user->email, 'password' => $credentials['password']])) {
            $token = $user->createToken('app-token')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token], 200);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
