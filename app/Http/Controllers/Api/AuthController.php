<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\estimate;
use App\Models\leads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function logins(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Login'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('crm-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => $user
        ]);
    }

    public function index()
    {
        $estimates = estimate::count();

        $leads = leads::count();

        $customers = customers::count();

        $todayEstimates = estimate::whereDate('created_at', today())->count();

        $todayLeads = leads::whereDate('created_at', today())->count();

        $monthlyLeads = leads::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $onlineUsers = User::where('Status', 'Online')->count();

        return response()->json([
            'status' => true,
            'data' => [
                'estimates' => $estimates,
                'leads' => $leads,
                'customers' => $customers,
                'today_estimates' => $todayEstimates,
                'today_leads' => $todayLeads,
                'monthly_leads' => $monthlyLeads,
                'online_users' => $onlineUsers,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged Out'
        ]);
    }
}
