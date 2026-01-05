<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'location_id',
        'brand_id',
        'unit_id',
        'item_code',
        'description',
        'sub_category',
        'purchase_cost',
        'sales_price',
        'unit_measure',
        'quantity',
        'ideal_quantity',
        'warn_quantity',
        'supplier_part_number',
        'notes',
    ];

    protected $casts = [
        'purchase_cost' => 'decimal:2',
        'sales_price' => 'decimal:2',
        'quantity' => 'integer',
        'ideal_quantity' => 'integer',
        'warn_quantity' => 'integer',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(ProductLocation::class);
    }

    public function movements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class);
    }

    // Scopes
    public function scopeLowStock($query)
    {
        return $query->whereHas('locations', function ($q) {
            $q->whereRaw('product_locations.quantity <= products.reorder_level');
        });
    }

    // Accessors
    public function getAvailableStockAttribute()
    {
        return $this->locations->sum(function ($location) {
            return $location->pivot->quantity - $location->pivot->reserved_quantity;
        });
    }

    public function getTotalValueAttribute()
    {
        return $this->available_stock * $this->cost;
    }
}
