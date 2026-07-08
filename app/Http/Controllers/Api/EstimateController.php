<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\estimate;
use App\Models\estimateitems;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstimateController extends Controller
{
    /**
     * List all estimates
     */
    public function index()
    {
        $estimates = estimate::with('items')
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $estimates
        ]);
    }

    /**
     * View single estimate
     */
    public function show($id)
    {
        $estimate = estimate::with('items')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $estimate
        ]);
    }

    /**
     * Create Estimate
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $subtotal = 0;

            foreach ($request->items as $item) {
                $value = $item['area'] * $item['rate'];

                $subtotal += $value;
            }

            $transportCharges = $request->transport_charges ?? 0;

            $taxableAmount = $subtotal + $transportCharges;

            $gstAmount = ($taxableAmount * $request->gst_percent) / 100;

            $netTotal = $taxableAmount + $gstAmount;

            $estimate = estimate::create([
                'estimate_no' => generateEstimateNumber(),
                'estimate_date' => now(),
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'mobile' => $request->mobile,
                'description' => $request->description,
                'subtotal' => $subtotal,
                'gst_percent' => $request->gst_percent,
                'gst_amount' => $gstAmount,
                'transport_charges' => $transportCharges,
                'net_total' => $netTotal,
                'estimatedby' => Auth::user()->name,
            ]);

            foreach ($request->items as $item) {
                $estimate->items()->create([
                    'location' => $item['location'],
                    'area' => $item['area'],
                    'rate' => $item['rate'],
                    'value' => $item['area'] * $item['rate'],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Estimate Created Successfully',
                'data' => $estimate->load('items')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update Estimate
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $estimate = estimate::findOrFail($id);

            $estimate->items()->delete();

            $subtotal = 0;

            foreach ($request->items as $item) {
                $value = $item['area'] * $item['rate'];

                $subtotal += $value;
            }

            $transportCharges = $request->transport_charges ?? 0;

            $taxableAmount = $subtotal + $transportCharges;

            $gstAmount = ($taxableAmount * $request->gst_percent) / 100;

            $netTotal = $taxableAmount + $gstAmount;

            $estimate->update([
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'mobile' => $request->mobile,
                'description' => $request->description,
                'subtotal' => $subtotal,
                'gst_percent' => $request->gst_percent,
                'gst_amount' => $gstAmount,
                'transport_charges' => $transportCharges,
                'net_total' => $netTotal,
            ]);

            foreach ($request->items as $item) {
                $estimate->items()->create([
                    'location' => $item['location'],
                    'area' => $item['area'],
                    'rate' => $item['rate'],
                    'value' => $item['area'] * $item['rate'],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Estimate Updated Successfully',
                'data' => $estimate->load('items')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete Estimate
     */
    public function destroy($id)
    {
        $estimate = estimate::findOrFail($id);

        $estimate->items()->delete();

        $estimate->delete();

        return response()->json([
            'status' => true,
            'message' => 'Estimate Deleted Successfully'
        ]);
    }

    public function pdf($id)
    {
        $estimate = estimate::with('items')->findOrFail($id);

        $amountWords = rupees_in_words($estimate->net_total);

        $pdf = PDF::loadView(
            'estimates.pdf',
            compact('estimate', 'amountWords')
        );

        return $pdf->download(
            'Estimate-' . $estimate->estimate_no . '.pdf'
        );
    }
}
