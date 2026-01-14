<?php

namespace App\Services;

use App\Models\InventoryMovement;
use App\Models\Location;
use App\Models\Product;
use App\Models\ProductLocation;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class StockService
{
    /**
     * Adjust stock for a product at a specific location and log an inventory movement.
     *
     * @param  Product  $product
     * @param  Location $location
     * @param  int      $quantityChange Positive for stock in, negative for stock out.
     * @param  string   $context       High level context: 'purchase', 'sale', 'adjustment', 'stock_count'.
     * @param  string|null $reference
     * @param  string|null $notes
     * @return void
     */
    public function adjustStock(
        Product $product,
        Location $location,
        int $quantityChange,
        string $context,
        ?string $reference = null,
        ?string $notes = null
    ): void {
        DB::transaction(function () use ($product, $location, $quantityChange, $context, $reference, $notes) {
            $productLocation = ProductLocation::firstOrCreate(
                [
                    'product_id' => $product->id,
                    'location_id' => $location->id,
                ],
                [
                    'quantity' => 0,
                    'reserved_quantity' => 0,
                ]
            );

            $newQuantity = $productLocation->quantity + $quantityChange;

            if ($newQuantity < 0) {
                throw new RuntimeException('Insufficient stock for this operation.');
            }

            $productLocation->quantity = $newQuantity;
            $productLocation->save();

            InventoryMovement::create([
                'product_id' => $product->id,
                'location_id' => $location->id,
                'type' => $quantityChange >= 0 ? 'in' : 'out',
                'quantity' => abs($quantityChange),
                'reference_number' => $reference,
                'notes' => trim(($context ? strtoupper($context) . ': ' : '') . ($notes ?? '')) ?: null,
            ]);
        });
    }
}


