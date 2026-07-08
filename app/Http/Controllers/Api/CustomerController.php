<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = customers::orderBy(
            'id',
            'DESC'
        )->get();

        return response()->json([
            'status' => true,
            'data' => $customers
        ]);
    }

    public function show($id)
    {
        $customer = customers::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $customer
        ]);
    }

    public function store(Request $request)
    {
        $customer = customers::create([
            'client_name' => $request->client_name,
            'Mobile' => $request->Mobile,
            'Location' => $request->Location,
            'Area' => $request->Area,
            'Product' => $request->Product,
            'Total_values' => $request->Total_values,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer Added',
            'data' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = customers::findOrFail($id);

        $customer->update([
            'client_name' => $request->client_name,
            'Mobile' => $request->Mobile,
            'Location' => $request->Location,
            'Area' => $request->Area,
            'Product' => $request->Product,
            'Total_values' => $request->Total_values,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer Updated',
            'data' => $customer
        ]);
    }

    public function destroy($id)
    {
        customers::findOrFail($id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer Deleted'
        ]);
    }
}
