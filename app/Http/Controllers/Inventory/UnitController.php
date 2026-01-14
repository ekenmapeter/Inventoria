<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::latest()->paginate(20);

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:units,name'],
            'symbol' => ['nullable', 'string', 'max:10'],
        ]);

        Unit::create($data);

        return redirect()->route('units.index')->with('status', 'Unit created successfully.');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:units,name,' . $unit->id],
            'symbol' => ['nullable', 'string', 'max:10'],
        ]);

        $unit->update($data);

        return redirect()->route('units.index')->with('status', 'Unit updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')->with('status', 'Unit deleted successfully.');
    }

    // API methods for dashboard integration
    public function apiIndex()
    {
        $units = Unit::withCount('products')->get();
        return response()->json($units);
    }

    public function apiStore(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:units,name',
            'symbol' => 'nullable|string|max:10',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $unit = Unit::create($request->only(['name', 'symbol', 'description']));

        return response()->json([
            'message' => 'Unit created successfully',
            'unit' => $unit
        ], 201);
    }

    public function apiUpdate(Request $request, Unit $unit)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
            'symbol' => 'nullable|string|max:10',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $unit->update($request->only(['name', 'symbol', 'description']));

        return response()->json([
            'message' => 'Unit updated successfully',
            'unit' => $unit
        ]);
    }

    public function apiDestroy(Unit $unit)
    {
        // Check if unit has products
        if ($unit->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete unit that has associated products'
            ], 422);
        }

        $unit->delete();

        return response()->json([
            'message' => 'Unit deleted successfully'
        ]);
    }
}
