<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all(['id', 'item_code', 'description']); // Get products for dropdown
        $latestProducts = Product::with(['category', 'supplier', 'location'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard', compact('latestProducts', 'products'));
    }

    public function getStats()
    {
        try {
            $totalProducts = Product::count();

            $lowStock = Product::whereRaw('quantity <= warn_quantity')->count();

            $totalValue = Product::sum(DB::raw('quantity * purchase_cost'));

            return response()->json([
                'total_products' => $totalProducts,
                'low_stock' => $lowStock,
                'total_value' => $totalValue,
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching dashboard stats',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
