<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\leads;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $lds = leads::with('feedbacks');

        if ($request->search) {
            $search = $request->search;

            $lds->where(function ($query) use ($search) {
                $query
                    ->where(
                        'Name',
                        'LIKE',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'Mobile',
                        'LIKE',
                        "%{$search}%"
                    );
            });
        }

        $lds = $lds->orderBy(
            'id',
            'DESC'
        )->get();

        return response()->json([
            'status' => true,
            'data' => $lds
        ]);
    }

    public function show($id)
    {
        $lead = leads::with('feedbacks')
            ->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $lead
        ]);
    }

    public function store(Request $request)
    {
        $lead = leads::create([
            'source' => $request->source,
            'Name' => $request->Name,
            'Mobile' => $request->Mobile,
            'email' => $request->email,
            'Product' => $request->Product,
            'Total_Area' => $request->Total_Area,
            'Description' => $request->Description,
            'Site_location' => $request->Site_location,
            'Status' => 'details shared'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Lead Created',
            'data' => $lead
        ]);
    }

    public function update(Request $request, $id)
    {
        $lead = leads::findOrFail($id);

        $lead->update([
            'source' => $request->source,
            'Name' => $request->Name,
            'Mobile' => $request->Mobile,
            'email' => $request->email,
            'Product' => $request->Product,
            'Total_Area' => $request->Total_Area,
            'Description' => $request->Description,
            'Site_location' => $request->Site_location,
            'Status' => $request->Status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Lead Updated'
        ]);
    }

    public function destroy($id)
    {
        $lead = leads::findOrFail($id);

        $lead->delete();

        return response()->json([
            'status' => true,
            'message' => 'Lead Deleted'
        ]);
    }
}
