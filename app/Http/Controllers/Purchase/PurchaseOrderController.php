<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Vendor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    //
    public function create()
    {
        $vendors = Vendor::where('status', 'Active')
            ->orderBy('company_name')
            ->get();

        $sites = customers::where('status', '!=', 'Completed')
            ->orderBy('client_name')
            ->get();

        return view(
            'Purchase.purchaseorders.create',
            compact(
                'vendors',
                'sites'
            )
        );
    }

    public function index()
    {
        $orders = PurchaseOrder::with([
            'vendor',
            'customer'
        ])
            ->latest()
            ->get();

        return view(
            'Purchase.purchaseorders.index',
            compact('orders')
        );
    }

    private function generatePoNo($company)
    {
        $prefix = $company == 'Amudha Decors' ? 'AD' : 'AR';

        $year = date('Y');
        $nextYear = substr($year + 1, -2);

        $financialYear = $year . '-' . $nextYear;

        $last = PurchaseOrder::where('company', $company)
            ->latest('id')
            ->first();

        if ($last) {
            $number = (int) substr($last->po_no, -4);

            $number++;
        } else {
            $number = 1;
        }

        return $prefix . '/PO/' . $financialYear . '/' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        // Uncomment this while debugging
        // dd($request->all());

        $request->validate([
            'company' => 'required',
            'vendor_id' => 'required',
            'site_id' => 'required',
            'po_template' => 'required',
            'po_date' => 'required',
        ]);

        if (!$request->has('material')) {
            return back()
                ->withInput()
                ->with('error', 'Please add at least one material.');
        }

        DB::beginTransaction();

        try {
            $po = PurchaseOrder::create([
                'po_no' => $this->generatePoNo($request->company),
                'company' => $request->company,
                'vendor_id' => $request->vendor_id,
                'site_id' => $request->site_id,
                'po_template' => $request->po_template,
                'po_date' => $request->po_date,
                'subtotal' => $request->subtotal ?? 0,
                'gst_percent' => $request->gst_percent ?? 0,
                'gst_amount' => $request->gst_amount ?? 0,
                'grand_total' => $request->grand_total ?? 0,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->name,
                'status' => 'Pending',
            ]);

            foreach ($request->material as $key => $material) {
                // Skip blank rows
                if (trim($material) == '') {
                    continue;
                }

                PurchaseOrderItem::create([
                    'purchase_order_id' => $po->id,
                    'material' => $material,
                    'size' => $request->size[$key] ?? null,
                    'width' => $request->width[$key] ?? null,  // added
                    'color' => $request->color[$key] ?? null,
                    'dia' => $request->dia[$key] ?? null,
                    'length' => $request->length[$key] ?? null,
                    'thickness' => $request->thickness[$key] ?? null,
                    'nos' => $request->nos[$key] ?? null,
                    'qty' => $request->qty[$key] ?? null,
                    'unit' => $request->unit[$key] ?? null,
                    'approx_weight' => $request->approx_weight[$key] ?? null,
                    'rate' => $request->rate[$key] ?? 0,
                    'amount' => $request->amount[$key] ?? 0,
                    'description' => $request->description[$key] ?? null,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('purchase.index')
                ->with('success', 'Purchase Order Created Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());
        }
    }

    public function loadTemplate($template)
    {
        $templates = [
            'anchor',
            'steelplate',
            'fabrication',
            'sandwichpanel',
            'gutter'
        ];

        if (!in_array($template, $templates)) {
            abort(404);
        }

        return view("Purchase.purchaseorders.templates.$template");
    }

    public function edit($id)
    {
        $po = PurchaseOrder::with('items')->findOrFail($id);

        $vendors = Vendor::where('status', 'Active')->get();

        $sites = customers::all();

        return view(
            'Purchase.purchaseorders.edit',
            compact(
                'po',
                'vendors',
                'sites'
            )
        );
    }

    public function view($id)
    {
        $po = PurchaseOrder::with([
            'vendor',
            'customer',
            'items'
        ])->findOrFail($id);

        return view(
            'Purchase.purchaseorders.view',
            compact('po')
        );
    }

    public function pdf($id)
    {
        $po = PurchaseOrder::with([
            'vendor',
            'customer',
            'items'
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'Purchase.purchaseorders.pdf.purchase',
            compact('po')
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream($po->po_no . '.pdf');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            PurchaseOrderItem::where('purchase_order_id', $id)->delete();

            PurchaseOrder::findOrFail($id)->delete();

            DB::commit();

            return redirect()
                ->route('purchase.index')
                ->with('success', 'Purchase Order Deleted Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company' => 'required',
            'vendor_id' => 'required',
            'site_id' => 'required',
            'po_template' => 'required',
            'po_date' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $po = PurchaseOrder::findOrFail($id);

            // Update Purchase Order Header
            $po->update([
                'company' => $request->company,
                'vendor_id' => $request->vendor_id,
                'site_id' => $request->site_id,
                'po_template' => $request->po_template,
                'po_date' => $request->po_date,
                'subtotal' => $request->subtotal ?? 0,
                'gst_percent' => $request->gst_percent ?? 0,
                'gst_amount' => $request->gst_amount ?? 0,
                'grand_total' => $request->grand_total ?? 0,
                'remarks' => $request->remarks,
            ]);

            // Existing item ids
            $existingIds = $po->items()->pluck('id')->toArray();

            $submittedIds = [];

            foreach ($request->material as $key => $material) {
                if (trim($material) == '') {
                    continue;
                }

                $itemData = [
                    'material' => $material,
                    'size' => $request->size[$key] ?? null,
                    'width' => $request->width[$key] ?? null,
                    'color' => $request->color[$key] ?? null,
                    'dia' => $request->dia[$key] ?? null,
                    'length' => $request->length[$key] ?? null,
                    'thickness' => $request->thickness[$key] ?? null,
                    'nos' => $request->nos[$key] ?? null,
                    'qty' => $request->qty[$key] ?? null,
                    'unit' => $request->unit[$key] ?? null,
                    'approx_weight' => $request->approx_weight[$key] ?? null,
                    'cutting_charge' => $request->cutting_charge[$key] ?? 0,
                    'rate' => $request->rate[$key] ?? 0,
                    'amount' => $request->amount[$key] ?? 0,
                    'description' => $request->description[$key] ?? null,
                ];

                // Existing row
                if (!empty($request->item_id[$key])) {
                    $item = PurchaseOrderItem::find($request->item_id[$key]);

                    if ($item) {
                        $item->update($itemData);

                        $submittedIds[] = $item->id;
                    }
                }
                // New row
                else {
                    $newItem = $po->items()->create($itemData);

                    $submittedIds[] = $newItem->id;
                }
            }

            // Delete removed rows
            $deleteIds = array_diff($existingIds, $submittedIds);

            PurchaseOrderItem::whereIn('id', $deleteIds)->delete();

            DB::commit();

            return redirect()
                ->route('purchase.index')
                ->with('success', 'Purchase Order Updated Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
