<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $suppliers = Supplier::all();
            return response()->json($suppliers);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch suppliers',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string'
            ]);

            $supplier = Supplier::create($validated);
            return response()->json($supplier, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create supplier',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            return response()->json($supplier);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch supplier',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string'
            ]);

            $supplier->update($validated);
            return response()->json($supplier);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update supplier',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return response()->json(['message' => 'Supplier deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete supplier',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
