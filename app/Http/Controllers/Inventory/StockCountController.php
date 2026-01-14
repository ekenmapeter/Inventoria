<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Adjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StockCountController extends Controller
{
    public function index()
    {
        return view('stock-counts.index');
    }

    public function create()
    {
        return view('stock-counts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.system_count' => 'required|integer|min:0',
            'items.*.physical_count' => 'required|integer|min:0',
            'items.*.difference' => 'required|integer',
            'location_id' => 'nullable|exists:locations,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $adjustmentsCreated = 0;

            foreach ($request->items as $item) {
                $difference = $item['difference'];

                // Only create adjustment if there's a difference
                if ($difference != 0) {
                    $product = Product::findOrFail($item['product_id']);

                    // Create adjustment record
                    Adjustment::create([
                        'product_id' => $item['product_id'],
                        'location_id' => $request->location_id,
                        'user_id' => optional(auth())->id() ?? 1,
                        'quantity_change' => $difference,
                        'reason' => 'Stock Count Adjustment',
                        'reference' => 'SC-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                    ]);

                    // Update product quantity
                    $product->increment('quantity', $difference);

                    $adjustmentsCreated++;
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Stock count completed successfully',
                'adjustments_created' => $adjustmentsCreated
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to complete stock count: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        // This would show a specific stock count if we were storing them
        // For now, just return a view
        return view('stock-counts.show');
    }

    public function apiStore(Request $request)
    {
        // Alias for store method to match route naming
        return $this->store($request);
    }
}
