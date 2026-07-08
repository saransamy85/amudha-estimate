<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\MaterialDispatch;
use App\Models\MaterialDispatchItem;
use App\Models\MaterialItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialItemController extends Controller
{
    public function index()
    {
        $customers = customers::whereIn('status', [
            'Yet to Start',
            'Progress'
        ])
            ->orderBy('client_name')
            ->get();

        return view('Reception.materialitems', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'from_location' => 'required',
            'to_location' => 'required',
            'transport_type' => 'required',
            'dispatch_date' => 'required',
            'item.*' => 'required',
            'quantity.*' => 'required',
            'unit.*' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $dispatch = MaterialDispatch::create([
                'customer_id' => $request->customer_id,
                'person_name' => $request->person_name,
                'from_location' => $request->from_location,
                'to_location' => $request->to_location,
                'transport_type' => $request->transport_type,
                'vehicle_no' => $request->vehicle_no,
                'transport_charge' => $request->transport_charge,
                'dispatch_date' => $request->dispatch_date,
                'user_name' => Auth::user()->name,
            ]);

            foreach ($request->item as $key => $item) {
                MaterialDispatchItem::create([
                    'dispatch_id' => $dispatch->id,
                    'item' => $item,
                    'quantity' => $request->quantity[$key],
                    'unit' => $request->unit[$key],
                    'description' => $request->description[$key],
                ]);
            }
        });

        return redirect()->route('receptionmaterialitems')->with('success', 'Dispatch Created Successfully.');
    }
}
