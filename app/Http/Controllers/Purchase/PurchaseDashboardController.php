<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Http\Request;

class PurchaseDashboardController extends Controller
{
    //
    public function index()
    {
        $totalVendor = Vendor::count();

        $totalPO = PurchaseOrder::count();

        $pendingPO = PurchaseOrder::where('status', 'Pending')->count();

        $approvedPO = PurchaseOrder::where('status', 'Approved')->count();

        return view('Purchase.dashboard', compact(
            'totalVendor',
            'totalPO',
            'pendingPO',
            'approvedPO'
        ));
    }
}
