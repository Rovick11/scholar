<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScholarshipController extends Controller
{
    public function claimScholarship(Request $request)
{
    try {
        Log::info('Claim Scholarship Request:', $request->all());

        // Validate that user_id exists in application_submissions, not users
        $validated = $request->validate([
            'user_id' => 'required|exists:application_submissions,user_id',
            'amount' => 'required|numeric',
            'claimed_at' => 'required|date',
        ]);

        // Insert into claimed table
        DB::table('claimed')->insert([
            'user_id' => $validated['user_id'],
            'amount' => $validated['amount'],
            'claimed_at' => $validated['claimed_at'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        Log::error('Claim Scholarship Error:', ['message' => $e->getMessage()]);
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}


public function showApproved()
{
    $claimedUserIds = DB::table('claimed')->pluck('user_id');

    $showApproved = DB::table('users')
        ->whereNotIn('id', $claimedUserIds)
        ->where('approved', true) // if you have an approval field
        ->get();

    return view('admin_scholarAward', compact('showApproved'));
}


}
