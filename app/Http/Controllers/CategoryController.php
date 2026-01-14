<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::withCount('products')
                ->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'description' => $category->description,
                        'items_count' => $category->products_count
                    ];
                });

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch categories',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories',
                'description' => 'nullable|string'
            ]);

            $category = Category::create($validated);

            return response()->json($category, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create category',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Category $category)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'description' => 'nullable|string'
            ]);

            $category->update($validated);

            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update category',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Category $category)
    {
        try {
            // Check if category has products
            if ($category->products()->exists()) {
                return response()->json([
                    'error' => 'Cannot delete category',
                    'message' => 'This category has associated products'
                ], 422);
            }

            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete category',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getBrands()
    {
        try {
            $brands = \App\Models\Brand::withCount('products')->get();

            return response()->json($brands);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch brands',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getUnits()
    {
        try {
            $units = \App\Models\Unit::withCount('products')->get();

            return response()->json($units);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch units',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAdjustments()
    {
        try {
            $adjustments = \App\Models\Adjustment::with(['product', 'location', 'user'])->latest()->get();

            return response()->json($adjustments);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch adjustments',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeBrand(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:brands',
                'description' => 'nullable|string'
            ]);

            $brand = \App\Models\Brand::create($validated);

            return response()->json($brand, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create brand',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateBrand(Request $request, \App\Models\Brand $brand)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
                'description' => 'nullable|string'
            ]);

            $brand->update($validated);

            return response()->json($brand);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update brand',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyBrand(\App\Models\Brand $brand)
    {
        try {
            // Check if brand has products
            if ($brand->products()->exists()) {
                return response()->json([
                    'error' => 'Cannot delete brand',
                    'message' => 'This brand has associated products'
                ], 422);
            }

            $brand->delete();
            return response()->json(['message' => 'Brand deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete brand',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeUnit(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:units',
                'symbol' => 'nullable|string|max:10',
                'description' => 'nullable|string'
            ]);

            $unit = \App\Models\Unit::create($validated);

            return response()->json($unit, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create unit',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateUnit(Request $request, \App\Models\Unit $unit)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
                'symbol' => 'nullable|string|max:10',
                'description' => 'nullable|string'
            ]);

            $unit->update($validated);

            return response()->json($unit);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update unit',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyUnit(\App\Models\Unit $unit)
    {
        try {
            // Check if unit has products
            if ($unit->products()->exists()) {
                return response()->json([
                    'error' => 'Cannot delete unit',
                    'message' => 'This unit has associated products'
                ], 422);
            }

            $unit->delete();
            return response()->json(['message' => 'Unit deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete unit',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeAdjustment(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'type' => 'required|in:addition,reduction',
                'quantity' => 'required|integer|min:1',
                'reason' => 'required|string',
                'notes' => 'nullable|string'
            ]);

            $adjustment = \App\Models\Adjustment::create([
                'product_id' => $validated['product_id'],
                'user_id' => Auth::id(),
                'quantity_change' => $validated['type'] === 'addition' ? $validated['quantity'] : -$validated['quantity'],
                'reason' => $validated['reason'],
                'reference' => 'ADJ-' . time(),
            ]);

            return response()->json($adjustment, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create adjustment',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
