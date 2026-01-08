<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Adjustment;
use Illuminate\Http\Request;
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

    public function getBrands()
    {
        try {
            $brands = Brand::withCount('products')
                ->get()
                ->map(function ($brand) {
                    return [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'description' => $brand->description,
                        'items_count' => $brand->products_count
                    ];
                });

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
            $units = Unit::withCount('products')
                ->get()
                ->map(function ($unit) {
                    return [
                        'id' => $unit->id,
                        'name' => $unit->name,
                        'symbol' => $unit->symbol,
                        'items_count' => $unit->products_count
                    ];
                });

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
            $adjustments = Adjustment::with(['product', 'user'])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($adjustment) {
                    return [
                        'id' => $adjustment->id,
                        'reference_number' => $adjustment->reference_number,
                        'product_name' => $adjustment->product ? $adjustment->product->description : 'N/A',
                        'adjustment_type' => $adjustment->adjustment_type,
                        'quantity' => $adjustment->quantity,
                        'reason' => $adjustment->reason,
                        'adjusted_by' => $adjustment->user ? $adjustment->user->name : 'N/A',
                        'adjustment_date' => $adjustment->adjustment_date ? $adjustment->adjustment_date->format('Y-m-d') : null,
                        'created_at' => $adjustment->created_at->format('Y-m-d H:i:s')
                    ];
                });

            return response()->json($adjustments);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch adjustments',
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
}
