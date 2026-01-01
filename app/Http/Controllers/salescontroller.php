<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\estimate;
use App\Models\customers;
use App\Models\estimateitems;
use App\Models\leads;
use App\Models\leadfeedback;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class salescontroller extends Controller
{
    //
    public function salesdash()
    {
        $estimates = estimate::latest()->get();
        $escount=estimate::count();
       
        
        return view('Sales/salesdashboard',compact('estimates'));
    }
    public function salescus()
    {
        $cli=customers::all();
        return view('Sales/salescustomer',compact('cli'));
    }
    public function leaddash()
    {
        $lds=leads::all();
        $leadfeed=leadfeedback::all();
        return view('Sales/leaddash',compact('lds','leadfeed'));
    }
    public function addlead(Request $request)
    {
        $alead=leads::create([
            'source'=>$request->source,
            'Name'=>$request->Name,
            'Mobile'=>$request->Mobile,
            'email'=>$request->email,
            'Product'=>$request->Product,
            'Total_Area'=>$request->Total_Area,
            'Description'=>$request->Description,
            'Site_location'=>$request->Site_location,
            'Status'=>$request->Status,
        ]);

        return redirect()->route('leaddash');

    }
    public function addfeedback(Request $request)
    {

      $request->validate([
        'lead_id' => 'required|exists:leads,id',
        'feedback' => 'required|string',
    ]);

    $lead = leads::findOrFail($request->lead_id);

    $lead->feedbacks()->create([
        'feedback' => $request->feedback,
    ]);
        return redirect()->route('leaddash');
    }
    
}
