<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\MaterialDispatchItem;
use App\Models\MaterialReturn;
use App\Models\MaterialReturnItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialReturnController extends Controller
{
    public function index()
    {
        $customers = customers::whereIn('status', [
            'Yet to Start',
            'Progress'
        ])
            ->orderBy('client_name')
            ->get();

        return view(
            'Reception.materialreturn',
            compact('customers')
        );
    }

    public function getDispatchItems($customer)
    {
        $items = MaterialDispatchItem::with([
            'dispatch',
            'returnItems'
        ])
            ->whereHas('dispatch', function ($q) use ($customer) {
                $q->where('customer_id', $customer);
            })
            ->get();

        $data = [];

        foreach ($items as $item) {
            $returned = $item->returnItems->sum('return_quantity');

            $balance = $item->quantity - $returned;

            if ($balance > 0) {
                $data[] = [
                    'dispatch_item_id' => $item->id,
                    'item' => $item->item,
                    'dispatch_qty' => $item->quantity,
                    'returned_qty' => $returned,
                    'balance' => $balance,
                    'unit' => $item->unit,
                    'description' => $item->description
                ];
            }
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'return_date' => 'required',
            'transport_type' => 'required'
        ]);

        DB::transaction(function () use ($request) {
            // Create Return Header

            $return = MaterialReturn::create([
                'return_no' => 'MR' . date('YmdHis'),
                'customer_id' => $request->customer_id,
                'person_name' => $request->person_name,
                'vehicle_no' => $request->vehicle_no,
                'transport_type' => $request->transport_type,
                'transport_charge' => $request->transport_charge ?? 0,
                'return_date' => $request->return_date,
                'remarks' => $request->remarks,
                'user_name' => Auth::user()->name
            ]);

            // Save Return Items

            foreach ($request->dispatch_item_id as $index => $dispatchItemId) {
                $qty = $request->return_quantity[$index];

                // Skip empty rows

                if ($qty == '' || $qty <= 0) {
                    continue;
                }

                $dispatchItem = MaterialDispatchItem::with('returnItems')
                    ->findOrFail($dispatchItemId);

                $alreadyReturned = $dispatchItem
                    ->returnItems
                    ->sum('return_quantity');

                $balance = $dispatchItem->quantity - $alreadyReturned;

                // Validation

                if ($qty > $balance) {
                    throw new \Exception(
                        $dispatchItem->item
                        . ' : Return quantity exceeds balance.'
                    );
                }

                MaterialReturnItem::create([
                    'return_id' => $return->id,
                    'dispatch_item_id' => $dispatchItem->id,
                    'return_quantity' => $qty,
                    'description' => $dispatchItem->description
                ]);
            }
        });

        return redirect()
            ->route('materialreturn')
            ->with(
                'success',
                'Material Return Saved Successfully.'
            );
    }
}
