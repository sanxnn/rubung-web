<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    protected $fillable = ['order_id', 'courier', 'tracking_number', 'scheduled_ship_date', 'shipped_at', 'delivered_at', 'status'];

    protected function casts(): array
    {
        return [
            'scheduled_ship_date' => 'date',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function trackingHistories(): HasMany
    {
        return $this->hasMany(TrackingHistory::class);
    }
}
