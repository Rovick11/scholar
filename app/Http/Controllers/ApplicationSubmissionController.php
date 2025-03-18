<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    public function getUserDoc(Request $request){

        $user = Auth::user();
        $application = ApplicationSubmission::where('user_id', $user->id)->latest()->first();

    
        if (!$user) {
            Log::error('Auth::user() returned null. User not authenticated.');
            abort(403, 'User not authenticated');
        }
    
        Log::info('Authenticated user:', ['id' => $user->id, 'name' => $user->firstName . ' ' . $user->lastName]);

    
        return view('user_docUpload', compact('application'));


    }

    public function applicationForm(Request $request)
    {
        try {
            $request->validate([
                'cor' => 'required|mimes:pdf,jpg,jpeg,png,doc,docx|max:5048',
                'grades' => 'required|mimes:pdf,jpg,jpeg,png,doc,docx|max:5048',
                'indigency' => 'required|mimes:pdf,jpg,jpeg,png,doc,docx|max:5048',
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
            $userId = auth()->id();

           

            foreach ($fileMappings as $inputKey => $dbKey) {
                if ($request->hasFile($inputKey)) {
                    $file = $request->file($inputKey);
                    $fileName = $userId . '-' . time() . '-' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads/' . $fileName, 'public');
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

    public function approveSubmission(Request $request, $id)
    {
        // Find the submission by ID
        $submission = ApplicationSubmission::find($id);
    
        if (!$submission) {
            return response()->json(['success' => false, 'message' => 'Submission not found.'], 404);
        }
    
        // Update the status to 'approved'
        $submission->status = 'approved';
        $submission->save();
    
        return response()->json(['success' => true, 'message' => 'Submission approved successfully.']);
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png,doc,docx|max:5048',
            'document_type' => 'required|string',
        ]);
    
        $application = ApplicationSubmission::findOrFail($id);
        $fieldName = $this->getFieldName($request->document_type);
    
        if ($fieldName) {
            // Delete the old file if it exists
            if ($application->$fieldName) {
                Storage::disk('public')->delete($application->$fieldName);
            }
    
            // Get the authenticated user ID
            $userId = auth()->id();
    
            // Create a new file name including the user ID
            $file = $request->file('file');
            $fileName = $userId . '-' . time() . '-' . $file->getClientOriginalName();
    
            // Store the new file in the 'uploads' directory
            $filePath = $file->storeAs('uploads', $fileName, 'public');
    
            // Update the database record with the new file path
            $application->$fieldName = $filePath;
            $application->save();
        }
    
        return response()->json(['success' => true, 'message' => 'Successfully Updated.']);
    }
    

    private function getFieldName($documentType)
    {
        $map = [
            'Certificate of Registration.pdf' => 'COR',
            'Grades Form.pdf' => 'gradesForm',
            'Indigency Certificate.pdf' => 'indigencyCertificate',
        ];
        return $map[$documentType] ?? null;
    }
}


