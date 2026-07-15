<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\estimate;
use App\Models\estimateitems;
use App\Models\leadfeedback;
use App\Models\leads;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class salescontroller extends Controller
{
    //
    public function salesdash()
    {
        $estimates = estimate::latest()->paginate(8);
        $lc = leads::count();
        $escount = estimate::count();
        $todayCount = estimate::whereDate('created_at', today())->count();
        $monthlyCount = leads::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        return view('Sales/salesdashboard', compact('estimates', 'todayCount', 'monthlyCount', 'lc'));
    }

    public function salescus()
    {
        $cli = customers::latest()->paginate(3);
        return view('Sales/salescustomer', compact('cli'));
    }

    public function leaddash(Request $request)
    {
        if (Auth::user()->Role == 'Admin') {
            return redirect()->route('adminlead');
        }

        $cuscount = customers::count();
        $lc = leads::count();

        $lds = Leads::with('feedbacks');

        if ($request->filled('search')) {
            $search = $request->search;

            $lds->where(function ($query) use ($search) {
                $query
                    ->where('Name', 'LIKE', "%{$search}%")
                    ->orWhere('Mobile', 'LIKE', "%{$search}%");
            });
        }

        $lds = $lds->latest()->get();

        $leadfeed = leadfeedback::all();

        $leadSC = leads::select('Status', \DB::raw('count(*) as total'))
            ->groupBy('Status')
            ->pluck('total', 'Status');

        $lsc = leads::select('source', \DB::raw('count(*) as total'))
            ->groupBy('source')
            ->pluck('total', 'source');
        $referenceLeads = leads::with('feedbacks')
            ->where('source', 'Reference')
            ->latest()
            ->paginate(10);

        return view('Sales/leaddash', compact(
            'lds',
            'leadfeed',
            'leadSC',
            'lsc',
            'lc',
            'cuscount',
            'referenceLeads'
        ));
    }

    public function addlead(Request $request)
    {
        $alead = leads::create([
            'source' => $request->source,
            'Name' => $request->Name,
            'Mobile' => $request->Mobile,
            'email' => $request->email,
            'Product' => $request->Product,
            'Total_Area' => $request->Total_Area,
            'Description' => $request->Description,
            'Site_location' => $request->Site_location,
            'Status' => $request->Status,
        ]);
        if (Auth::user()->Role == 'Admin') {
            return redirect()->route('adminlead');
        }
        return redirect()->route('leaddash');
    }

    public function addfeedback(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'feedback' => 'required|string',
        ]);

        $lead = leads::findOrFail($request->lead_id);
        $lead->update([
            'Status' => $request->status,
        ]);
        $lead->feedbacks()->create([
            'feedback' => $request->feedback,
        ]);
        if (Auth::user()->Role == 'Admin') {
            return redirect()->route('adminlead');
        }

        return redirect()->route('leaddash');
    }

    public function addestimate()
    {
        return view('sales/addestimate');
    }

    public function salesgreetings()
    {
        return view('sales/salesgreetings');
    }
}
