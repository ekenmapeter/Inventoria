<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Location;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $products = Product::with(['category', 'supplier', 'location', 'brand', 'unit'])
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                      ->orWhere('item_code', 'like', "%{$search}%");
                });
            })
            ->when(request('category'), function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->when(request('supplier'), function ($query, $supplier) {
                $query->where('supplier_id', $supplier);
            })
            ->when(request('low_stock'), function ($query) {
                $query->where('quantity', '<=', DB::raw('warn_quantity'));
            })
            ->latest()
            ->paginate(10);

        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'suppliers'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();

        return view('products.create', compact('categories', 'suppliers', 'locations', 'brands', 'units'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'item_code' => 'required|string|unique:products,item_code',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sub_category' => 'nullable|string|max:255',
            'purchase_cost' => 'required|numeric|min:0',
            'sales_price' => 'required|numeric|min:0',
            'unit_id' => 'nullable|exists:units,id',
            'unit_measure' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:0',
            'ideal_quantity' => 'nullable|integer|min:0',
            'warn_quantity' => 'nullable|integer|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
            'supplier_part_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Create the product
            $product = Product::create($validatedData);

            // Handle file uploads (if any)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('product_images', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }

            DB::commit();
            return response()->json($product, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create product', 'details' => $e->getMessage()], 500);
        }
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories', 'suppliers', 'locations', 'brands', 'units'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sub_category' => 'nullable|string|max:255',
            'purchase_cost' => 'required|numeric|min:0',
            'sales_price' => 'required|numeric|min:0',
            'unit_id' => 'nullable|exists:units,id',
            'unit_measure' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:0',
            'ideal_quantity' => 'nullable|integer|min:0',
            'warn_quantity' => 'nullable|integer|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
            'supplier_part_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $product->update($validated);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('product_images', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }

            DB::commit();
            return response()->json($product);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update product', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        try {
            DB::beginTransaction();

            // Delete associated images from storage
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
            }

            $product->delete();

            DB::commit();
            return response()->json(['message' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete product', 'details' => $e->getMessage()], 500);
        }
    }

    public function deleteImage(ProductImage $image)
    {
        $this->authorize('update', $image->product);

        try {
            Storage::disk('public')->delete($image->path);
            $image->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting product image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // API methods for dashboard integration
    public function apiIndex(Request $request)
    {
        $query = Product::with(['category', 'supplier', 'location', 'brand', 'unit']);

        // Apply filters
        if ($request->has('location_id') && $request->location_id) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->has('supplier_id') && $request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $products = $query->get();

        return response()->json($products);
    }

    public function apiLatest(Request $request)
    {
        $limit = $request->get('limit', 10);
        $products = Product::with(['category', 'supplier', 'location'])
            ->latest()
            ->take($limit)
            ->get();

        return response()->json($products);
    }

    public function apiStore(Request $request)
    {
        // This is an alias for the store method to match API naming
        return $this->store($request);
    }
}
