<?php

namespace App\Http\Controllers;

use App\Models\LeadActivity;
use App\Models\leads;
use Illuminate\Http\Request;

class LeadActivitycontroller extends Controller
{
    public function store(Request $request)
    {
        LeadActivity::create([
            'lead_id' => $request->lead_id,
            'activity_type' => $request->activity_type,
            'description' => $request->description
        ]);

        return back()->with('success', 'Activity Added');
    }

    public function create()
    {
        $leads = leads::orderBy('id', 'DESC')->get();

        return view('admin/leadactivity', compact('leads'));
    }
}
