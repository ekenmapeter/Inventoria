<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'expected_date',
        'billing_address',
        'issue_date',
        'location_id',
        'shipping_address',
        'tracking_ref',
        'ship_by',
        'order_note',
        'internal_note',
        'subtotal',
        'total',
        'status'
    ];

    protected $casts = [
        'expected_date' => 'date',
        'issue_date' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}