<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Adjustment;
use App\Models\Location;
use App\Models\Product;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}


