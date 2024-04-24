<?php

namespace App\Http\Controllers;

use App\Models\ReportReason;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'question_report' => 'required',
            // 'other_reason' => 'required', Remove this line
        ]);

        // Check if the selected reason is "Other"
        if ($data['question_report'] === 'Other') {
            $otherReasonData = $request->validate([
                'other_reason' => 'required|string|max:255',
            ]);
            $otherReason = $otherReasonData['other_reason'];
        } else {
            $otherReason = null;
        }

        // Save the data to the database
        ReportReason::create([
            'reason' => $data['question_report'],
            'other_reason' => $otherReason, // Set the other_reason here
        ]);

        return redirect()->back()->with('message', 'Report submitted successfully!');
    }
}
