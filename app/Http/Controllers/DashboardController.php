<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            // Basic product stats
            $totalProducts = Product::count();
            $lowStock = Product::whereRaw('quantity <= warn_quantity')->count();
            $totalValue = Product::sum(DB::raw('quantity * purchase_cost'));

            // Financial stats
            $currentYear = Carbon::now()->year;

            // Revenue (total sales for current year)
            $revenue = Sale::whereYear('sold_at', $currentYear)
                ->where('status', 'completed')
                ->sum('total_amount') ?? 0;

            // Sale Returns (assuming negative sales or separate return table)
            $saleReturns = 0; // Placeholder - would need a returns table

            // Purchase Returns
            $purchaseReturns = 0; // Placeholder - would need a returns table

            // Total purchases for profit calculation
            $totalPurchases = Purchase::whereYear('purchased_at', $currentYear)
                ->where('status', 'completed')
                ->sum('total_amount') ?? 0;

            // Profit calculation (Revenue - Cost of Goods Sold - Operating Expenses)
            $cogs = SaleItem::join('products', 'sale_items.product_id', '=', 'products.id')
                ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
                ->whereYear('sales.sold_at', $currentYear)
                ->where('sales.status', 'completed')
                ->sum(DB::raw('sale_items.quantity * products.purchase_cost')) ?? 0;

            $profit = $revenue - $cogs;

            return response()->json([
                'total_products' => $totalProducts,
                'low_stock' => $lowStock,
                'total_value' => $totalValue,
                'revenue' => $revenue,
                'sale_returns' => $saleReturns,
                'purchase_returns' => $purchaseReturns,
                'profit' => $profit,
                'cash_flow' => '-', // Placeholder for cash flow calculation
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

    public function getRecentTransactions()
    {
        try {
            $transactions = Sale::with(['customer', 'items'])
                ->where('status', 'completed')
                ->orderBy('sold_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($sale) {
                    return [
                        'date' => $sale->sold_at ? $sale->sold_at->format('m-d-Y') : 'N/A',
                        'reference' => $sale->reference ?? 'N/A',
                        'customer' => $sale->customer ? $sale->customer->name : 'Walk in Customer',
                        'status' => ucfirst($sale->status),
                        'grand_total' => '$' . number_format($sale->total_amount, 2)
                    ];
                });

            return response()->json([
                'transactions' => $transactions,
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching recent transactions',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getBestSellers($period = 'month', $type = 'quantity')
    {
        try {
            $query = SaleItem::with(['product'])
                ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
                ->where('sales.status', 'completed')
                ->select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(total) as total_amount'));

            // Apply period filter
            if ($period === 'month') {
                $query->whereMonth('sales.sold_at', Carbon::now()->month)
                      ->whereYear('sales.sold_at', Carbon::now()->year);
            } elseif ($period === 'year') {
                $query->whereYear('sales.sold_at', Carbon::now()->year);
            }

            $results = $query->groupBy('product_id')
                ->orderBy($type === 'quantity' ? 'total_quantity' : 'total_amount', 'desc')
                ->limit(5)
                ->get();

            $bestSellers = $results->map(function ($item) use ($type) {
                return [
                    'product_details' => ($item->product ? $item->product->description : 'Unknown Product') .
                                       ' [' . ($item->product ? $item->product->item_code : 'N/A') . ']',
                    'qty' => $type === 'quantity' ? intval($item->total_quantity) : null,
                    'grand_total' => $type === 'price' ? '$' . number_format($item->total_amount, 2) : null
                ];
            });

            return response()->json([
                'best_sellers' => $bestSellers,
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching best sellers',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCashFlowMatrix()
    {
        try {
            $currentYear = Carbon::now()->year;
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            $cashFlowData = [];

            foreach ($months as $index => $month) {
                $monthNum = $index + 1;

                // Payments received (sales)
                $paymentsReceived = Sale::whereYear('sold_at', $currentYear)
                    ->whereMonth('sold_at', $monthNum)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0;

                // Payments sent (purchases)
                $paymentsSent = Purchase::whereYear('purchased_at', $currentYear)
                    ->whereMonth('purchased_at', $monthNum)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0;

                $cashFlowData[] = [
                    'month' => $month,
                    'payments_received' => $paymentsReceived,
                    'payments_sent' => $paymentsSent,
                    'net_cash_flow' => $paymentsReceived - $paymentsSent
                ];
            }

            return response()->json([
                'cash_flow_matrix' => $cashFlowData,
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching cash flow matrix',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getRevenueExpenseMatrix()
    {
        try {
            $currentYear = Carbon::now()->year;
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            $matrixData = [];

            foreach ($months as $index => $month) {
                $monthNum = $index + 1;

                // Revenue (sales)
                $revenue = Sale::whereYear('sold_at', $currentYear)
                    ->whereMonth('sold_at', $monthNum)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0;

                // Purchases (expenses)
                $purchases = Purchase::whereYear('purchased_at', $currentYear)
                    ->whereMonth('purchased_at', $monthNum)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0;

                // Calculate profit
                $profit = $revenue - $purchases;

                $matrixData[] = [
                    'month' => $month,
                    'revenue' => $revenue,
                    'purchases' => $purchases,
                    'profit' => $profit
                ];
            }

            return response()->json([
                'revenue_expense_matrix' => $matrixData,
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching revenue expense matrix',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getYearlyReport()
    {
        try {
            $currentYear = Carbon::now()->year;

            // Monthly breakdown for the year
            $monthlyData = [];
            for ($month = 1; $month <= 12; $month++) {
                $revenue = Sale::whereYear('sold_at', $currentYear)
                    ->whereMonth('sold_at', $month)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0;

                $purchases = Purchase::whereYear('purchased_at', $currentYear)
                    ->whereMonth('purchased_at', $month)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0;

                $monthlyData[] = [
                    'month' => Carbon::createFromFormat('m', $month)->format('M'),
                    'revenue' => $revenue,
                    'purchases' => $purchases,
                    'profit' => $revenue - $purchases
                ];
            }

            // Yearly totals
            $yearlyTotals = [
                'total_revenue' => Sale::whereYear('sold_at', $currentYear)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0,
                'total_purchases' => Purchase::whereYear('purchased_at', $currentYear)
                    ->where('status', 'completed')
                    ->sum('total_amount') ?? 0,
                'total_products' => Product::count(),
                'low_stock_items' => Product::whereRaw('quantity <= warn_quantity')->count()
            ];

            $yearlyTotals['total_profit'] = $yearlyTotals['total_revenue'] - $yearlyTotals['total_purchases'];

            return response()->json([
                'yearly_report' => [
                    'monthly_data' => $monthlyData,
                    'totals' => $yearlyTotals
                ],
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching yearly report',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
