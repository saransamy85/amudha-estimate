<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    //

    public function index()
    {
        $vendors = Vendor::latest()->get();

        return view('Purchase.vendors.index', compact('vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'mobile' => 'required'
        ]);

        Vendor::create([
            'company_name' => $request->company_name,
            'contact_person' => $request->contact_person,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'gst_no' => $request->gst_no,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'status' => $request->status
        ]);

        return back()->with('success', 'Vendor Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->update($request->all());

        return back()->with('success', 'Vendor Updated Successfully');
    }

    public function destroy($id)
    {
        Vendor::findOrFail($id)->delete();

        return back()->with('success', 'Vendor Deleted Successfully');
    }
}
