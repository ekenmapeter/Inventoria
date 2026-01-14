<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'location', 'user'])
            ->latest()
            ->paginate(20);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $products = Product::orderBy('description')->get();

        return view('purchases.create', compact('suppliers', 'locations', 'products'));
    }

    public function store(Request $request, StockService $stockService)
    {
        $data = $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'reference' => ['nullable', 'string', 'max:255'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $stockService) {
            $purchase = Purchase::create([
                'supplier_id' => $data['supplier_id'],
                'location_id' => $data['location_id'],
                'user_id' => Auth::id(),
                'reference' => $data['reference'] ?? null,
                'status' => 'completed',
                'purchased_at' => now(),
                'total_amount' => 0,
            ]);

            $location = Location::findOrFail($data['location_id']);
            $total = 0;

            foreach ($data['items'] as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                $lineTotal = $itemData['quantity'] * $itemData['unit_price'];
                $total += $lineTotal;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->id,
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'line_total' => $lineTotal,
                ]);

                $stockService->adjustStock(
                    $product,
                    $location,
                    $itemData['quantity'],
                    'purchase',
                    $purchase->id,
                    $data['reference'] ?? null
                );
            }

            $purchase->update([
                'total_amount' => $total,
            ]);
        });

        return redirect()
            ->route('purchases.index')
            ->with('status', 'Purchase recorded and stock updated.');
    }
}
