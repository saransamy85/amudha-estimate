<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\customers;
use App\Models\estimate;
use App\Models\estimateitems;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\leads;
use App\Models\leadfeedback;
use DB;

class reportcontroller extends Controller
{
    //
     public function adminreport()
    {
        if(session()->has('username'))
        {
            $escount=estimate::count();
            $lc=leads::count();
            $leadSC = leads::select('Status', \DB::raw('count(*) as total'))->groupBy('Status')->pluck('total', 'Status');
            $lsc = leads::select('source', \DB::raw('count(*) as total'))->groupBy('source')->pluck('total', 'source');

            $monthlyLeads = leads::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )->whereYear('created_at', now()->year)
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();

            return view('admin/reports',compact('escount','lc','leadSC','lsc','monthlyLeads'));
        }
        return redirect()->route('login')->with('error',"You must Login");
    }
}
