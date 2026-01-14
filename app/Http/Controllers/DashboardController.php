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

    public function getFinancialOverview()
    {
        try {
            // For now, return static data as requested by user
            // In a real application, this would calculate from sales, purchases, etc.
            $financialData = [
                'revenue' => 502.87,
                'sale_return' => 0.00,
                'purchase_return' => 0.00,
                'cash_flow' => -100.13, // payment received - payment sent
                'profit' => 402.74, // revenue - expenses
            ];

            return response()->json($financialData);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching financial overview',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getYearlyStats()
    {
        try {
            // For now, return static yearly data as requested by user
            // In a real application, this would calculate from database transactions
            $yearlyStats = [
                'purchases' => 1250.50,
                'revenue' => 1847.25,
                'expenses' => 447.51,
            ];

            return response()->json($yearlyStats);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching yearly stats',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getRecentTransactions()
    {
        // Placeholder method for recent transactions
        return response()->json([]);
    }

    public function getBestSellers($period, $type)
    {
        // Placeholder method for best sellers
        return response()->json([]);
    }

    public function getCashFlowMatrix()
    {
        // Placeholder method for cash flow matrix
        return response()->json([]);
    }

    public function getRevenueExpenseMatrix()
    {
        // Placeholder method for revenue expense matrix
        return response()->json([]);
    }

    public function getYearlyReport()
    {
        // Placeholder method for yearly report
        return response()->json([]);
    }
}
