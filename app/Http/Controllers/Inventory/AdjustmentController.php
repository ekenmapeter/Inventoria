<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Adjustment;
use App\Models\Location;
use App\Models\Product;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdjustmentController extends Controller
{
    public function index()
    {
        $adjustments = Adjustment::with(['product', 'location', 'user'])
            ->latest()
            ->paginate(20);

        return view('adjustments.index', compact('adjustments'));
    }

    public function create()
    {
        $products = Product::orderBy('description')->get();
        $locations = Location::orderBy('name')->get();

        return view('adjustments.create', compact('products', 'locations'));
    }

    public function store(Request $request, StockService $stockService)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'quantity_change' => ['required', 'integer', 'not_in:0'],
            'reason' => ['nullable', 'string', 'max:255'],
            'reference' => ['nullable', 'string', 'max:255'],
        ]);

        $product = Product::findOrFail($data['product_id']);
        $location = Location::findOrFail($data['location_id']);

        $adjustment = Adjustment::create([
            'product_id' => $product->id,
            'location_id' => $location->id,
            'user_id' => Auth::id(),
            'quantity_change' => $data['quantity_change'],
            'reason' => $data['reason'] ?? null,
            'reference' => $data['reference'] ?? null,
        ]);

        $stockService->adjustStock(
            $product,
            $location,
            $data['quantity_change'],
            'adjustment',
            $adjustment->id,
            $data['reason'] ?? null
        );

        return redirect()
            ->route('adjustments.index')
            ->with('status', 'Stock adjustment recorded successfully.');
    }

    public function show(Adjustment $adjustment)
    {
        $adjustment->load(['product', 'location', 'user']);

        return view('adjustments.show', compact('adjustment'));
    }

    // API methods for dashboard integration
    public function apiIndex(Request $request)
    {
        $query = Adjustment::with(['product.category', 'product.supplier', 'product.location'])
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                  ->orWhereHas('product', function($productQuery) use ($search) {
                      $productQuery->where('description', 'like', "%{$search}%")
                                  ->orWhere('item_code', 'like', "%{$search}%");
                  });
            });
        }

        $adjustments = $query->paginate(15);

        return response()->json($adjustments);
    }

    public function apiStore(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'location_id' => 'required|exists:locations,id',
            'quantity_change' => 'required|integer|not_in:0',
            'reason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            // Get the product
            $product = Product::findOrFail($request->product_id);
            $originalQuantity = $product->quantity;

            $newQuantity = $originalQuantity + $request->quantity_change;

            // Ensure quantity doesn't go negative
            if ($newQuantity < 0) {
                return response()->json([
                    'message' => 'Adjustment would result in negative stock quantity'
                ], 422);
            }

            // Generate reference number
            $reference = 'ADJ-' . date('Ymd') . '-' . str_pad(Adjustment::count() + 1, 4, '0', STR_PAD_LEFT);

            // Create adjustment record
            $adjustment = Adjustment::create([
                'product_id' => $request->product_id,
                'location_id' => $request->location_id,
                'user_id' => optional(auth())->id() ?? 1,
                'quantity_change' => $request->quantity_change,
                'reason' => $request->reason,
                'reference' => $reference,
            ]);

            // Update product quantity
            $product->update(['quantity' => $newQuantity]);

            DB::commit();

            return response()->json([
                'message' => 'Stock adjustment created successfully',
                'adjustment' => $adjustment->load('product'),
                'new_quantity' => $newQuantity
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create adjustment: ' . $e->getMessage()
            ], 500);
        }
    }
}
