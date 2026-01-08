<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'type',
        'package_id',
        'payment_method',
        'payment_proof',
        'notes',
        'status',
        'user_id',
        'admin_id',
        'approved_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isMonthlyDue(): bool
    {
        return $this->type === 'monthly_due';
    }

    public function isSubscription(): bool
    {
        return $this->type === 'subscription';
    }

    public function isFundraise(): bool
    {
        return $this->type === 'fundraise';
    }
}
