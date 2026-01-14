<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'location', 'user'])
            ->latest()
            ->paginate(20);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $products = Product::orderBy('description')->get();

        return view('sales.create', compact('customers', 'locations', 'products'));
    }

    public function store(Request $request, StockService $stockService)
    {
        $data = $request->validate([
            'customer_id' => ['nullable', 'exists:customers,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'reference' => ['nullable', 'string', 'max:255'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $stockService) {
            $sale = Sale::create([
                'customer_id' => $data['customer_id'] ?? null,
                'location_id' => $data['location_id'],
                'user_id' => Auth::id(),
                'reference' => $data['reference'] ?? null,
                'status' => 'completed',
                'sold_at' => now(),
                'total_amount' => 0,
            ]);

            $location = Location::findOrFail($data['location_id']);
            $total = 0;

            foreach ($data['items'] as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                $lineTotal = $itemData['quantity'] * $itemData['unit_price'];
                $total += $lineTotal;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'line_total' => $lineTotal,
                ]);

                // Stock goes out on sale
                $stockService->adjustStock(
                    $product,
                    $location,
                    -$itemData['quantity'],
                    'sale',
                    $sale->id,
                    $data['reference'] ?? null
                );
            }

            $sale->update([
                'total_amount' => $total,
            ]);
        });

        return redirect()
            ->route('sales.index')
            ->with('status', 'Sale recorded and stock updated.');
    }
}


