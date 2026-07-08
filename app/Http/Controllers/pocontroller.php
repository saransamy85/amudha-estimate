<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class pocontroller extends Controller
{
    //
    public function podashboard()
    {
        return view('Purchase/dashboard');
    }
    public function poviews()
    {
        return Pdf::loadView('Purchase/formats/poview')
        // ->setPaper('A4', 'portrait')
        ->download();
        
    }
}
