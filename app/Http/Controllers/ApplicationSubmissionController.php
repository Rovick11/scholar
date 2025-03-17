<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApplicationSubmissionController extends Controller
{
    

    public function getUser(Request $request)
    {
        $user = Auth::user();
        $application = ApplicationSubmission::where('user_id', $user->id)->latest()->first();
        $applicationStatus = $application ? $application->status : 'new';
    
        if (!$user) {
            Log::error('Auth::user() returned null. User not authenticated.');
            abort(403, 'User not authenticated');
        }
    
        Log::info('Authenticated user:', ['id' => $user->id, 'name' => $user->firstName . ' ' . $user->lastName]);

    
        return view('user_appSub', compact('user', 'applicationStatus'));
    }

    public function applicationForm(Request $request)
    {
        try {
            $request->validate([
                'cor' => 'required|mimes:pdf|max:5048',
                'grades' => 'required|mimes:pdf|max:5048',
                'indigency' => 'required|mimes:pdf|max:5048',
            ]);

            $user = Auth::user();

            $pdffiles = [
                'user_id' => $user->id,
                'COR' => null,
                'gradesForm' => null,
                 'indigencyCertificate' => null,
                'status' => 'pending'
            ];

            $fileMappings = [
                'cor' => 'COR',
                'grades' => 'gradesForm',
                'indigency' => 'indigencyCertificate'
            ];

            foreach ($fileMappings as $inputKey => $dbKey) {
                if ($request->hasFile($inputKey)) {
                    $file = $request->file($inputKey);
                    $fileName = time() . '-' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads', $fileName, 'public');
                    $pdffiles[$dbKey] = $path;
                }
            }

    
            ApplicationSubmission::create($pdffiles);
            Log::info('Inserting application submission data:', $pdffiles);

            return response()->json([
                'success' => true,
                'redirect' => url('/user_appStatus'),
                'message' => 'Successful submission!'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed submission', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed submission',
                'error' => $e->getMessage()
            ], 400);
        }
    }
    public function showSubmissions(Request $request)
    {
        // Fetch all application submissions with status 'pending'
        $submissions = ApplicationSubmission::where('status', 'pending')->get();
    
        // Debugging: Check if submissions are fetched
        if ($submissions->isEmpty()) {
            Log::info('No submissions found.');
        } else {
            Log::info('Submissions found:', $submissions->toArray());
        }
    
        // Pass the submissions to the view
        return view('admin_userAppMan', compact('submissions'));
    }
    public function showApplicationStatus(Request $request)
    {
        try {
            $userId = auth()->id();
            
            if (!$userId) {
                Log::warning('Unauthenticated user tried to access application status.');
                return back()->with('error', 'You must be logged in to view applications.');
            }

            Log::info('Fetching application status for user.', ['user_id' => $userId]);

            $applications = ApplicationSubmission::where('user_id', $userId)->get();

            Log::info('Applications retrieved successfully.', ['count' => $applications->count()]);
      
            return view('user_appStatus', compact('applications'));

        } catch (\Exception $e) {
            Log::error('Error fetching application status.', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Unable to fetch application status.');
        }
    }


}
