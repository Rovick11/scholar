<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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
                'role' => 'required|in:user,pending',
                'contact' => 'required|string|max:10',
                'barangay' => 'required',
                'sex' => 'required',
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);

            Log::info('Validation passed');

            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email, // Ensure email is included
                'birthDate' => $request->birthdate,
                'role' => $request->role,
                'contactNo' => $request->contact,
                'password' => Hash::make($request->password),
                'barangay' => $request->barangay,
                'sex' => $request->sex,
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


    public function login(Request $request){

        try{

            $request->validate([
                'email'=> "required",
                'password'=>"required"
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)){
                $user= Auth::user();

                if ($user->role === 'superAdmin' || $user->role === 'admin'){
                    return response()->json([
                        'success' => true,
                        'message' => 'login successful!',
                        'role'=> $user->role
                    ]);
                }
                if ($user->role === 'user'){
                    return response()->json([
                        'success' => true,
                        'message' => 'login successful!',
                        'role'=> $user->role
                    ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'role'=> $user->role
                    ]);
                }
            }
            Log::info('User  login successfully', ['user_id' => $user->id]);

          
        } catch (\Exception $e) {
            Log::error('login failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'login failed.',
                'error' => $e->getMessage()
            ], 400);
        }


    }

    public function logout(Request $request){

        try{

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response ()->json([

                'success' => true,
                'message' => 'Successfully Logout',
        
            ]);

            Log::info('logout successfully');

            } catch(\Exception $e){

            return response()->json([
                'success'=> false,
                'error' => $e->getMessage()
            ]);
            }

    }

    public function update(Request $request, $id) 
    {
        $user = User::findOrFail($id); // Find user or return 404
    
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ignore current user's email
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:10',
            'barangay' => 'required',
            'sex' => 'required',
           
        ]);
    
        // Update user fields
        $user->update([
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'email' => $request->email,
            'birthDate' => $request->birth_date,         
            'contactNo' => $request->phone,
            'barangay' => $request->barangay,
            'sex' => $request->sex,

        ]);
    
        return response()->json(['success' => true, 'message' => 'Successfully Updated.']);
    }
}
