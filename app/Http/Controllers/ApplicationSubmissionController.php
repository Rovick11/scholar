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
    
        if (!$user) {
            Log::error('Auth::user() returned null. User not authenticated.');
            abort(403, 'User not authenticated');
        }
    
        Log::info('Authenticated user:', ['id' => $user->id, 'name' => $user->firstName . ' ' . $user->lastName]);

    
        return view('user_appSub', compact('user'));
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
                'indigency Certificate' => null,
            ];

            $fileMappings = [
                'cor' => 'COR',
                'grades' => 'gradesForm',
                'indigency' => 'indigency Certificate'
            ];

            foreach ($fileMappings as $inputKey => $dbKey) {
                if ($request->hasFile($inputKey)) {
                    $file = $request->file($inputKey);
                    $fileName = time() . '-' . $file->getClientOriginalName();
                    $path = $file->storeAs('public/uploads', $fileName);
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

}
