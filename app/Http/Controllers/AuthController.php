<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Log::info('Registration request received', ['data' => $request->all()]);

        try {
            $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email', // Added email validation
                'birthdate' => 'required|date',
                'role' => 'required|in:user,admin',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            Log::info('Validation passed');

            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email, // Ensure email is included
                'birthDate' => $request->birthdate,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            Log::info('User  registered successfully', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful!'
            ]);
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Registration failed.',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
