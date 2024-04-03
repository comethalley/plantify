<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function submitReport(Request $request)
    {
        $data = $request->all();

        // Validate ang request base sa iyong kinakailangan
        $request->validate([
            'report' => 'required', // Siguruhin na ang "report" field ay hindi empty
        ]);

        $this->saveReport($data);

        $message = "Question added successfully.";
        return redirect()->back()->with('validationmessage', 'Thanks we will report your .');;
    }

    private function saveReport($data)
    {
        // Gumawa ng bagong instance ng Report model
        $report = new Report();

        // Itakda ang mga column ng database base sa data na naipasa mula sa form
        $report->content = $data['report']; // Assuming 'report' ang pangalan ng field

        // Kung may laman ang "Other" field, isama ito sa content ng report
        if (!empty($data['content-8'])) {
            $report->content .= ": " . $data['content-8'];
        }

        // I-save ang report sa database
        $report->save();
    }
}
