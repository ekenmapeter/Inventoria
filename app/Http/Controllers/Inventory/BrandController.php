<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(20);

        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:brands,name'],
            'description' => ['nullable', 'string'],
        ]);

        Brand::create($data);

        return redirect()->route('brands.index')->with('status', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:brands,name,' . $brand->id],
            'description' => ['nullable', 'string'],
        ]);

        $brand->update($data);

        return redirect()->route('brands.index')->with('status', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brands.index')->with('status', 'Brand deleted successfully.');
    }

    // API methods for dashboard integration
    public function apiIndex()
    {
        $brands = Brand::withCount('products')->get();
        return response()->json($brands);
    }

    public function apiStore(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $brand = Brand::create($request->only(['name', 'description']));

        return response()->json([
            'message' => 'Brand created successfully',
            'brand' => $brand
        ], 201);
    }

    public function apiUpdate(Request $request, Brand $brand)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $brand->update($request->only(['name', 'description']));

        return response()->json([
            'message' => 'Brand updated successfully',
            'brand' => $brand
        ]);
    }

    public function apiDestroy(Brand $brand)
    {
        // Check if brand has products
        if ($brand->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete brand that has associated products'
            ], 422);
        }

        $brand->delete();

        return response()->json([
            'message' => 'Brand deleted successfully'
        ]);
    }
}
