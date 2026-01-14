<?php

namespace App\Http\Controllers\Manufacturing;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Product;
use App\Models\Production;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductionController extends Controller
{
    public function index()
    {
        $productions = Production::with(['product', 'location', 'user'])
            ->latest()
            ->paginate(20);

        return view('productions.index', compact('productions'));
    }

    public function create()
    {
        $products = Product::orderBy('description')->get();
        $locations = Location::orderBy('name')->get();

        return view('productions.create', compact('products', 'locations'));
    }

    public function store(Request $request, StockService $stockService)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $product = Product::findOrFail($data['product_id']);
        $location = Location::findOrFail($data['location_id']);

        $production = Production::create([
            'product_id' => $product->id,
            'location_id' => $location->id,
            'user_id' => Auth::id(),
            'quantity' => $data['quantity'],
            'produced_at' => now(),
            'notes' => $data['notes'] ?? null,
        ]);

        // Finished goods come into stock
        $stockService->adjustStock(
            $product,
            $location,
            $data['quantity'],
            'production',
            $production->id,
            $data['notes'] ?? null
        );

        return redirect()
            ->route('productions.index')
            ->with('status', 'Production recorded and stock updated.');
    }
}


