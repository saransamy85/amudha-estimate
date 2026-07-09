<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\MaterialDispatch;
use App\Models\MaterialDispatchItem;
use App\Models\MaterialReturn;
use App\Models\MaterialReturnItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceptionReportController extends Controller
{
    //
    public function dashboard()
    {
        $dispatchCount = MaterialDispatch::count();

        $todayDispatch = MaterialDispatch::whereDate('dispatch_date', Carbon::today())->count();

        $returnCount = MaterialReturn::count();

        $transportCharge = MaterialDispatch::sum('transport_charge');

        $recentDispatch = MaterialDispatch::with('customer')
            ->latest()
            ->take(10)
            ->get();

        return view(
            'Reception/reports',
            compact(
                'dispatchCount',
                'todayDispatch',
                'returnCount',
                'transportCharge',
                'recentDispatch'
            )
        );
    }
}
