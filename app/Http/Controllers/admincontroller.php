<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\estimate;
use App\Models\estimateitems;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\leads;
use App\Models\leadfeedback;
use DB;

class admincontroller extends Controller
{
    //
    public function dashboard()
    {
        if(session()->has('username'))
        {
            $estimates = estimate::latest()->get();
            $escount=estimate::count();
            $cuscount=customers::count();
            $onl=User::where('Status','Online')->get();
            return view('admin/dashboard',compact('estimates','escount','cuscount','onl'));
        }
        return redirect()->route('login')->with('error',"You must Login");
    }
   

    public function registration()
    {
        return view('Auth/registration');
    }
    public function regsubmission(Request $request)
    {
        $uu=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'Role'=>$request->Role,
        ]);
        return redirect()->route('login');
    }
    public function login()
    {
        return view('Auth/login');
    }
    public function logins(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        $cred=$request->only('email','password');

        if(Auth::attempt($cred))
        {
            $request->session()->regenerate();
            session(['username'=>Auth::user()->name]);
            auth()->user()->update(['Status'=>'Online']);
            if(Auth::user()->Role=='Sales')
            {
                return redirect()->route('salesdashboard');
                
            }
            
            return redirect()->route('dashboard1');
            // return redirect('/estimates');
        }
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->withInput();
    }
    public function logout()
    {
        auth()->user()->update(['Status'=>'Offline']);
        Auth::logout();
        // Clear all session data
            session()->invalidate();
        // Regenerate CSRF token
            session()->regenerateToken();
            
        return redirect()->route('login');
    }

    public function adminlead()
    {
        $escount=estimate::count();
        $cuscount=customers::count();
        $onl=User::where('Status','Online')->get();
        $lds=leads::all();
        $leadfeed=leads::with('feedbacks')->get();
        return view('admin/admin-lead',compact('onl','escount','cuscount','lds','leadfeed'));
    }
    public function admincus()
    {
         $cli=customers::all();   
        return view('admin/customer',compact('cli'));
    }
}
