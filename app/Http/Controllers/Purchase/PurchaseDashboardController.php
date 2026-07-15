<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Http\Request;

class PurchaseDashboardController extends Controller
{
    //

    public function getvendorcount()
    {
        return Vendor::count();
    }

    public function getpocount()
    {
        return PurchaseOrder::count();
    }

    public function index()
    {
        $totalVendor = $this->getvendorcount();

        $totalPO = $this->getpocount();

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
