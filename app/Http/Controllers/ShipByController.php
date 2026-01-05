<?php

namespace App\Http\Controllers;

use App\Models\ShipBy;
use Illuminate\Http\Request;

class ShipByController extends Controller
{
    public function index()
    {
        try {
            $shipBy = ShipBy::where('is_active', true)->get();
            return response()->json($shipBy);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching shipping methods'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            $shipBy = ShipBy::create($validated);

            return redirect()->back()->with('success', 'Shipping method added successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}