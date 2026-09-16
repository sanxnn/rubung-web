<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomOrder extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id', 'customer_name', 'customer_phone', 'description',
        'design_image_url', 'requested_price', 'admin_price',
        'status', 'admin_note',
    ];

    protected function casts(): array
    {
        return [
            'requested_price' => 'decimal:2',
            'admin_price' => 'decimal:2',
            'status' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
