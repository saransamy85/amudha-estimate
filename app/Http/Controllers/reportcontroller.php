<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\estimate;
use App\Models\estimateitems;
use App\Models\leadfeedback;
use App\Models\leads;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class reportcontroller extends Controller
{
    //
    public function adminreport()
    {
        if (session()->has('username')) {
            $escount = estimate::count();
            $lc = leads::count();
            $leadSC = leads::select('Status', \DB::raw('count(*) as total'))->groupBy('Status')->pluck('total', 'Status');
            $lsc = leads::select('source', \DB::raw('count(*) as total'))->groupBy('source')->pluck('total', 'source');

            $today = Carbon::today();

            $todayLeads = leads::whereDate('created_at', $today)->count();

            $todayEstimates = estimate::whereDate('created_at', $today)->count();

            $todayFeedbacks = leadfeedback::whereDate('created_at', $today)->count();

            $todayCustomers = customers::whereDate('created_at', $today)->count();

            $monthlyLeads = leads::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
                ->whereYear('created_at', now()->year)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();

            return view('admin/reports', compact('escount', 'lc', 'leadSC', 'lsc', 'monthlyLeads', 'todayLeads', 'todayEstimates', 'todayFeedbacks', 'todayCustomers'));
        }
        return redirect()->route('login')->with('error', 'You must Login');
    }

    public function customReportForm()
    {
        return view('admin.custom-report');
    }

    public function customReportPdf(Request $request)
    {
        $from = Carbon::parse($request->from_date)->startOfDay();

        $to = Carbon::parse($request->to_date)->endOfDay();

        // Summary

        $totalLeads = leads::whereBetween('created_at', [$from, $to])->count();

        $totalEstimates = estimate::whereBetween('created_at', [$from, $to])->count();

        $totalCustomers = customers::whereBetween('created_at', [$from, $to])->count();

        // Lead Source

        $leadSources = leads::select(
            'source',
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();

        // Product

        $productReport = leads::select(
            'Product',
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('Product')
            ->orderByDesc('total')
            ->get();

        // Status

        $statusReport = leads::select(
            'Status',
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('Status')
            ->orderByDesc('total')
            ->get();

        // Confirmed Orders

        $confirmedOrders = leads::whereBetween('created_at', [$from, $to])
            ->where('Status', 'Confirmed')
            ->latest()
            ->get();

        $confirmedCount = $confirmedOrders->count();

        $confirmedAmount = $confirmedOrders->sum('net_total');

        $pdf = PDF::loadView(
            'admin.monthly-report-pdf',
            compact(
                'from',
                'to',
                'totalLeads',
                'totalEstimates',
                'totalCustomers',
                'leadSources',
                'productReport',
                'statusReport',
                'confirmedOrders',
                'confirmedCount',
                'confirmedAmount'
            )
        );

        return $pdf->download(
            'Business_Report_' . $from->format('d-m-Y') . '_To_' . $to->format('d-m-Y') . '.pdf'
        );
    }
}
