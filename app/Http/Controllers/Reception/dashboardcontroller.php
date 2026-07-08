<?php

namespace App\Http\Controllers\Reception;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\MaterialDispatch;
use App\Models\MaterialDispatchItem;
use App\Models\MaterialReturn;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    //
    public function index()
    {
        $totalCustomers = customers::count();

        $yetToStart = customers::where('status', 'Yet to Start')->count();

        $progress = customers::where('status', 'Progress')->count();

        $completed = customers::where('status', 'Completed')->count();

        $dispatches = MaterialDispatch::with([
            'customer',
            'items'
        ])
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();;

        return view('Reception/dashboard', compact('dispatches', 'totalCustomers', 'yetToStart', 'progress', 'completed'));
    }

    public function sites()
    {
        $sites = customers::with('materialDispatches')
            ->whereIn('status', ['Yet to Start', 'Progress'])
            ->orderBy('created_at', 'DESC')
            ->get();
        $cli = customers::all();
        return view('Reception/sites', compact('cli', 'sites'));
    }

    public function siteTimeline($id)
    {
        $customer = customers::findOrFail($id);

        $dispatches = MaterialDispatch::with('items')
            ->where('customer_id', $id)
            ->latest()
            ->get();

        $dispatchCount = $dispatches->count();

        $transportTotal = $dispatches->sum('transport_charge');

        $materialCount = 0;

        foreach ($dispatches as $dispatch) {
            $materialCount += $dispatch->items->count();
        }

        return view('Reception/timeline', compact('customer', 'dispatches', 'dispatchCount', 'transportTotal', 'materialCount'));
    }

    public function history()
    {
        $returns = MaterialReturn::with([
            'customer',
            'items.dispatchItem'
        ])
            ->latest()
            ->paginate(10);

        return view('Reception.returnhistory', compact('returns'));
    }

    public function returnview($id)
    {
        $return = MaterialReturn::with([
            'customer',
            'items.dispatchItem'
        ])->findOrFail($id);

        return view(
            'Reception.returnview',
            compact('return')
        );
    }
}
