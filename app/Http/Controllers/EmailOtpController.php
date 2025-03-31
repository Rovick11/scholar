<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\User;

class EmailOtpController extends Controller
{
    // Send OTP
    public function sendOtp(Request $request)
    {
        Log::info('OTP request received', ['email' => $request->email]);

        $request->validate(['email' => 'required|email']);

        $otp = rand(100000, 999999); // Generate 6-digit OTP
        Session::put('otp', $otp);
        Session::put('otp_email', $request->email);
        Session::put('otp_expire', now()->addMinutes(5)); // OTP expires in 5 mins

        Log::info('OTP generated', ['otp' => $otp, 'email' => $request->email]);

        try {
            Mail::raw("Your OTP Code: $otp", function ($message) use ($request) {
                $message->to($request->email)
                        ->subject("Your OTP Code");
            });

            Log::info('OTP email sent successfully', ['email' => $request->email]);
        } catch (\Exception $e) {
            Log::error('Failed to send OTP email', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to send OTP email.'], 500);
        }

        return response()->json(['message' => 'OTP sent successfully!']);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        Log::info('OTP verification request received', ['email' => Session::get('otp_email')]);

        $request->validate(['otp' => 'required|numeric']);

        $storedOtp = Session::get('otp');
        $storedEmail = Session::get('otp_email');
        $otpExpire = Session::get('otp_expire');

        if (!$storedOtp || !$storedEmail || now()->greaterThan($otpExpire)) {
            Log::warning('OTP expired or missing', ['email' => $storedEmail]);
            return response()->json(['success' => false, 'message' => 'OTP expired!']);
        }

        if ($storedOtp == $request->otp) {
            Log::info('OTP verified successfully', ['email' => $storedEmail]);
            return response()->json(['success' => true, 'message' => 'OTP verified!']);
        }

        Log::warning('Invalid OTP attempt', ['email' => $storedEmail, 'entered_otp' => $request->otp]);
        return response()->json(['success' => false, 'message' => 'Invalid OTP!']);
    }

    // Update Profile After OTP Verification
    public function updateProfile(Request $request, $id)
{
    Log::info('Profile update request received', ['user_id' => $id]);

    // Validate input
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id, // Ignore current user's email
        'birth_date' => 'required|date',
        'phone' => 'required|string|max:10',
        'otp' => 'nullable|numeric',
        'password' => 'nullable|min:8|confirmed',
        'barangay' => 'required',
        'sex' => 'required',
        'middle_initial' => 'string',
        'university' => 'required',
        'course' => 'required',
        'semester' => 'required',
        'year' => 'required'
    ]);

    // Check OTP before proceeding with update
    /*if (Session::get('otp') != $request->otp) {
        Log::warning('Invalid OTP for profile update', ['user_id' => $id]);
        return response()->json(['success' => false, 'message' => 'Invalid OTP'], 400);
    }*/

    // Fetch user
    $user = User::find($id);
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found'], 404);
    }

    // Prepare data for update
    $updateData = [
        'firstName' => $request->first_name,
        'lastName' => $request->last_name,
        'email' => $request->email,
        'birthDate' => $request->birth_date,
        'contactNo' => $request->phone,
        'barangay' => $request->barangay,
        'sex' => $request->sex,
        'middleName' => $request->middle_initial,
        'university' => $request->university,
        'semester' => $request->semester,
        'year' => $request->year,
        'course' => $request->course,
    ];

    // Update password only if provided
    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    // Perform update
    $user->update($updateData);

    Log::info('User profile updated successfully', ['user_id' => $id]);

    // Clear OTP session
    Session::forget(['otp', 'otp_email', 'otp_expire']);

    return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
}


}
