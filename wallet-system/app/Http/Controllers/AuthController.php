<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'phone_number' => 'required|unique:users',
            'password' => 'required|min:4',
        ]);

        // Create a new user instance and hash the password
        $user = User::create([
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
        ]);

        // Generate a token for the newly created user
        return response()->json(['token' => $user->createToken('authToken')->plainTextToken]);
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->only('phone_number', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful, get the authenticated user
            $user = Auth::user();
            return response()->json(['token' => $user->createToken('authToken')->plainTextToken]);
        }

        // Authentication failed
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}



