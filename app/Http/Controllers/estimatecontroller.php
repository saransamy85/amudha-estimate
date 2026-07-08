<?php

namespace App\Http\Controllers;

use App\Models\estimate;
use App\Models\estimateitems;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class estimatecontroller extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $estimates = estimate::latest()->get();
            return view('estimates/index', compact('estimates'));
        }
        return redirect()->route('login')->with('error', 'You must Login');
    }

    public function create()
    {
        return view('estimates.create');
    }

    public function store(Request $request)
    {
        // DB::beginTransaction();

        try {
            $subtotal = 0;

            foreach ($request->area as $i => $area) {
                $rate = $request->rate[$i];
                $value = $area * $rate;
                $subtotal += $value;
            }

            $transportCharges = $request->transport_charges ?? 0;

            $taxableAmount = $subtotal + $transportCharges;

            $gstAmount = ($taxableAmount * $request->gst_percent) / 100;

            $netTotal = $taxableAmount + $gstAmount;

            $baseName = $request->customer_name;
            $finalName = $baseName;

            if ($request->boolean('re_estimate')) {
                $latest = Estimate::where('customer_name', 'LIKE', $baseName . '®%')
                    ->orderByRaw('LENGTH(customer_name) DESC')
                    ->orderBy('customer_name', 'DESC')
                    ->first();

                if ($latest) {
                    preg_match('/®(\d+)$/', $latest->customer_name, $matches);

                    $next = isset($matches[1]) ? $matches[1] + 1 : 1;

                    $finalName = $baseName . '®' . $next;
                } else {
                    $finalName = $baseName . '®';
                }
            }

            $estimate = Estimate::create([
                'estimate_no' => generateEstimateNumber(),
                'estimate_date' => now(),
                'customer_name' => $finalName,
                'customer_address' => $request->address_line1 . ', ' . $request->address_line2,
                'mobile' => $request->mobile,
                'description' => $request->description,
                'subtotal' => $subtotal,
                'gst_percent' => $request->gst_percent,
                'gst_amount' => $gstAmount,
                'transport_charges' => $transportCharges,
                'net_total' => $netTotal,
                'estimatedby' => Auth::user()->name,
            ]);

            foreach ($request->area as $i => $area) {
                $rate = $request->rate[$i];
                $value = $area * $rate;

                $estimate->items()->create([
                    'location' => $request->location[$i],
                    'area' => $area,
                    'rate' => $rate,
                    'value' => $value,
                ]);
            }

            // DB::commit();

            return redirect()
                ->route('estimates.show', $estimate->id)
                ->with('success', 'Estimate created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        if (session()->has('username')) {
            $estimate = estimate::with('items')->findOrFail($id);
            $amountWords = rupees_in_words($estimate->net_total);
            return view('estimates.show', compact('estimate', 'amountWords'));
        }
        return redirect()->route('login')->with('error', 'You must Login');
    }

    public function edit($id)
    {
        if (session()->has('username')) {
            $estimate = estimate::with('items')->findOrFail($id);
            return view('estimates.edit', compact('estimate'));
        }
        return redirect()->route('login')->with('error', 'You must Login');
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $estimate = estimate::findOrFail($id);
            $estimate->items()->delete();

            $subtotal = array_sum($request->value);
            $gstAmount = ($subtotal * $request->gst_percent) / 100;
            $netTotal = $subtotal + $gstAmount + $request->transportation;

            $estimate->update([
                'customer_name' => $request->customer_name,
                'customer_address' => $request->address_line1 . ', ' . $request->address_line2,
                'mobile' => $request->mobile,
                'description' => $request->description,
                'subtotal' => $subtotal,
                'gst_percent' => $request->gst_percent,
                'gst_amount' => $gstAmount,
                'net_total' => $netTotal,
            ]);

            foreach ($request->location as $i => $loc) {
                $estimate->items()->create([
                    'location' => $loc,
                    'area' => $request->area[$i],
                    'rate' => $request->rate[$i],
                    'value' => $request->value[$i],
                ]);
            }
        });

        return redirect()
            ->route('estimates.index')
            ->with('success', 'Estimate Updated Successfully');
    }

    public function destroy($id)
    {
        estimate::destroy($id);
        return back()->with('success', 'Estimate Deleted');
    }

    public function pdf($id)
    {
        if (session()->has('username')) {
            $estimate = estimate::with('items')->findOrFail($id);
            $amountWords = rupees_in_words($estimate->net_total);
            $pdf = PDF::loadView('estimates.pdf', compact('estimate', 'amountWords'));
            return $pdf->stream('Estimate-' . $estimate->estimate_no . '.pdf');
        }
        return redirect()->route('login')->with('error', 'You must Login');
    }
}
