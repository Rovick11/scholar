<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; 
use App\Models\User;

class sendEmail extends Controller
{
    // Send OTP
    public function sendEmail(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);
    
        // Fetch the user by ID
        $user = User::findOrFail($id);
    
        Log::info('OTP request received', ['email' => $user->email]);
    
        // Log the email content safely (avoiding sensitive data)
        Log::info('Preparing email', ['subject' => $request->subject, 'message_preview' => substr($request->message, 0, 50)]);
    
        try {
            // Send the email using Mail::raw
            Mail::raw("$user->email: $request->message", function ($message) use ($user, $request) {
                $message->to($user->email)
                        ->subject($request->subject);
            });
    
            Log::info('Email sent successfully', ['to' => $user->email, 'subject' => $request->subject]);
    
        } catch (\Exception $e) {
            // Log the error with detailed message
            Log::error('Failed to send email', ['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
            
            // Return an error response with a clear message
            return response()->json(['message' => 'Failed to send email.', 'error' => $e->getMessage()], 500);
        }
    
        // Return success response
        return response()->json(['message' => 'Email sent successfully!']);
    }
    
    

}
