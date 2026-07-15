<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\estimate;
use App\Models\estimateitems;
use App\Models\leadfeedback;
use App\Models\leads;
use App\Models\PurchaseOrder;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class admincontroller extends Controller
{
    //

    public function getEstimateCount()
    {
        return estimate::count();
    }

    public function getCustomerCount()
    {
        return customers::count();
    }

    public function getLeadCount()
    {
        return leads::count();
    }

    public function dashboard()
    {
        if (session()->has('username')) {
            $estimates = estimate::latest()->get();
            $escount = $this->getEstimateCount();
            $cuscount = $this->getCustomerCount();
            $onl = User::where('Status', 'Online')->get();
            $lc = $this->getLeadCount();
            $todayCount = estimate::whereDate('created_at', today())->count();
            $monthlyCount = leads::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
            return view('admin/dashboard', compact('estimates', 'escount', 'cuscount', 'onl', 'lc', 'todayCount', 'monthlyCount'));
        }
        return redirect()->route('login')->with('error', 'You must Login');
    }

    public function registration()
    {
        return view('Auth/registration');
    }

    public function regsubmission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'Role' => 'required|in:Sales,Receptionist,Purchase'
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'Role' => $request->Role,
            ]);

            return redirect()
                ->route('login')
                ->with('success', 'User registered successfully.');
        } catch (Exception $e) {
            Log::error('User Registration Error', [
                'message' => $e->getMessage(),
                'email' => $request->email,
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Unable to register user. Please try again.');
        }
    }

    public function login()
    {
        return view('Auth/login');
    }

    public function logins(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
            }

            $request->session()->regenerate();

            session([
                'username' => Auth::user()->name
            ]);

            Auth::user()->update([
                'Status' => 'Online'
            ]);

            switch (Auth::user()->Role) {
                case 'Sales':
                    return redirect()->route('salesdashboard');

                case 'Receptionist':
                    return redirect()->route('receptiondashboard');

                case 'Purchase':
                    return redirect()->route('purchasedashboard');

                case 'Admin':
                default:
                    return redirect()->route('dashboard1');
            }
        } catch (Exception $e) {
            Log::error('Login Error: ' . $e->getMessage(), [
                'email' => $request->email,
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }

    public function logout()
    {
        auth()->user()->update(['Status' => 'Offline']);
        Auth::logout();
        // Clear all session data
        session()->invalidate();
        // Regenerate CSRF token
        session()->regenerateToken();

        return redirect()->route('login');
    }

    public function adminlead(Request $request)
    {
        if (Auth::user()->Role == 'Admin') {
            $lc = leads::count();
            $escount = $this->getEstimateCount();
            $cuscount = $this->getCustomerCount();
            $onl = User::where('Status', 'Online')->get();
            $referenceLeads = leads::with('feedbacks')
                ->where('source', 'Reference')
                ->latest()
                ->get();

            $lds = Leads::with('feedbacks');

            if ($request->search != '') {
                $search = $request->search;

                $lds->where(function ($query) use ($search) {
                    $query
                        ->where('Name', 'LIKE', "%{$search}%")
                        ->orWhere('Mobile', 'LIKE', "%{$search}%");
                });
            }

            $lds = $lds->orderBy('id', 'DESC')->get();

            $leadSC = leads::select('Status', \DB::raw('count(*) as total'))
                ->groupBy('Status')
                ->pluck('total', 'Status');

            $lsc = leads::select('source', \DB::raw('count(*) as total'))
                ->groupBy('source')
                ->pluck('total', 'source');

            return view('admin/admin-lead', compact(
                'onl',
                'lds',
                'lc',
                'leadSC',
                'lsc',
                'escount',
                'cuscount',
                'referenceLeads'
            ));
        }

        return redirect()->route('leaddash');
    }

    public function admincus()
    {
        $cli = customers::all();
        $escount = $this->getEstimateCount();
        $cuscount = $this->getCustomerCount();
        $lc = $this->getLeadCount();
        return view('admin/customer', compact('cli', 'escount', 'cuscount', 'lc'));
    }

    public function dailyReportPdf()
    {
        $today = Carbon::today();

        $todayLeads = leads::whereDate('created_at', $today)->count();

        $todayEstimates = estimate::whereDate('created_at', $today)->count();

        $todayFeedbacks = leadfeedback::whereDate('created_at', $today)->count();

        $todayCustomers = customers::whereDate('created_at', $today)->count();

        $leadSC = leads::select(
            'Status',
            DB::raw('count(*) as total')
        )
            ->groupBy('Status')
            ->pluck('total', 'Status');

        $lsc = leads::select(
            'source',
            DB::raw('count(*) as total')
        )
            ->groupBy('source')
            ->pluck('total', 'source');

        $todayLeadList = leads::whereDate('created_at', $today)->get();
        $todayFeedbackList = leadfeedback::with('lead')
            ->whereDate('created_at', $today)
            ->latest()
            ->get();

        $monthlyLeads = leads::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $escount = estimate::count();

        $lc = leads::count();

        $pdf = PDF::loadView(
            'admin/daily-report-pdf',
            compact(
                'todayLeads',
                'todayEstimates',
                'todayFeedbacks',
                'todayCustomers',
                'todayLeadList',
                'todayFeedbackList'
            )
        );

        return $pdf->download(
            'Daily_Report_' . $today->format('d-m-Y') . '.pdf'
        );
    }

    public function weeklyReportPdf()
    {
        $from = Carbon::today()->subDays(6);
        $to = Carbon::today();

        $weeklyLeads = leads::whereBetween('created_at', [$from, $to])->count();

        $weeklyEstimates = estimate::whereBetween('created_at', [$from, $to])->count();

        $weeklyFeedbacks = leadfeedback::whereBetween('created_at', [$from, $to])->count();

        $weeklyCustomers = customers::whereBetween('created_at', [$from, $to])->count();

        $weeklyEstimateValue = estimate::whereBetween('created_at', [$from, $to])
            ->sum('net_total');

        $weeklyLeadList = leads::whereBetween('created_at', [$from, $to])
            ->latest()
            ->get();

        $weeklyEstimateList = estimate::whereBetween('created_at', [$from, $to])
            ->latest()
            ->get();

        $weeklyCustomerList = customers::whereBetween('created_at', [$from, $to])
            ->latest()
            ->get();

        $weeklyFeedbackList = leadfeedback::with('lead')
            ->whereBetween('created_at', [$from, $to])
            ->latest()
            ->get();

        $leadStatus = leads::whereBetween('created_at', [$from, $to])
            ->select('Status', DB::raw('COUNT(*) as total'))
            ->groupBy('Status')
            ->pluck('total', 'Status');

        $leadSource = leads::whereBetween('created_at', [$from, $to])
            ->select('source', DB::raw('COUNT(*) as total'))
            ->groupBy('source')
            ->pluck('total', 'source');

        $pdf = PDF::loadView(
            'admin.weekly-report-pdf',
            compact(
                'from',
                'to',
                'weeklyLeads',
                'weeklyEstimates',
                'weeklyCustomers',
                'weeklyFeedbacks',
                'weeklyEstimateValue',
                'weeklyLeadList',
                'weeklyEstimateList',
                'weeklyCustomerList',
                'weeklyFeedbackList',
                'leadStatus',
                'leadSource'
            )
        );

        return $pdf->download(
            'Weekly_Report_' . $from->format('d-m-Y')
            . '_to_' . $to->format('d-m-Y') . '.pdf'
        );
    }

    public function po_orders()
    {
        $orders = PurchaseOrder::with([
            'vendor',
            'customer'
        ])
            ->latest()
            ->get();
        return view('admin/po_orders', compact('orders'));
    }
}
