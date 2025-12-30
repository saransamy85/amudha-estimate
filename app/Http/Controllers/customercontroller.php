<?php

namespace App\Http\Controllers;
use App\Models\customers;

use Illuminate\Http\Request;

class customercontroller extends Controller
{
    //
    public function clients()
    {
        $cli=customers::all();
        return view('admin/customer',compact('cli'));
    }
    public function clientstore(Request $request)
    {

        $custom=customers::create([
            'client_name'=>$request->cusname,
            'Mobile'=>$request->cusmob,
            'Location'=>$request->cuslocation,
            'Area'=>$request->cusarea,
            'Product'=>$request->cusproduct,
            'Total_values'=>$request->cusvalue,
        ]);
        return redirect()->route('customers');
    }
}
