<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Location;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function generate(Request $request)
    {
        try {
            $query = Product::query()
                ->with(['category', 'location']) // Eager load relationships
                ->select([
                    'products.*',
                    DB::raw('CAST(quantity AS DECIMAL(10,2)) * CAST(purchase_cost AS DECIMAL(10,2)) as total_value')
                ]);

            // Apply filters if provided
            if ($request->location_id) {
                $query->where('location_id', $request->location_id);
            }
            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
            }
            if ($request->supplier_id) {
                $query->where('supplier_id', $request->supplier_id);
            }

            $products = $query->get();

            $items = $products->map(function ($item) {
                $totalValue = $item->quantity * $item->purchase_cost;
                return [
                    'item_code' => $item->item_code,
                    'description' => $item->description,
                    'description_short' => Str::limit($item->description, 30, '...'),
                    'category_name' => $item->category ? $item->category->name : '-',
                    'location_name' => $item->location ? $item->location->name : '-',
                    'quantity' => $item->quantity,
                    'purchase_cost' => number_format($item->purchase_cost, 2, '.', ''),
                    'total_value' => number_format($totalValue, 2, '.', '')
                ];
            });

            // Calculate summary
            $totalValue = $products->sum(function($item) {
                return $item->quantity * $item->purchase_cost;
            });

            $summary = [
                'total_items' => $items->count(),
                'total_value' => number_format($totalValue, 2, '.', ''),
                'low_stock_items' => $products->where('quantity', '<=', DB::raw('warn_quantity'))->count()
            ];

            return response()->json([
                'items' => $items,
                'summary' => $summary
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate report',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function export($format)
    {
        // Implementation for export functionality
    }
}
