<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id', 'custom_order_id', 'order_number', 'shipping_name',
        'shipping_phone', 'shipping_address', 'shipping_city',
        'shipping_province', 'shipping_postal_code', 'subtotal',
        'discount_amount', 'total', 'dp_type', 'dp_value', 'dp_amount',
        'paid_amount', 'remaining_amount', 'payment_status', 'status',
        'agreed_delivery_date', 'snapshot_promo', 'snapshot_address',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total' => 'decimal:2',
            'dp_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'remaining_amount' => 'decimal:2',
            'agreed_delivery_date' => 'date',
            'snapshot_promo' => 'array',
            'snapshot_address' => 'array',
            'payment_status' => 'string',
            'status' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customOrder(): BelongsTo
    {
        return $this->belongsTo(CustomOrder::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function reschedules(): HasMany
    {
        return $this->hasMany(DeliveryReschedule::class);
    }

    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class);
    }
}
