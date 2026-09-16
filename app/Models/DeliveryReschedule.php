<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryReschedule extends Model
{
    use HasUuids;

    protected $fillable = ['order_id', 'original_date', 'requested_date', 'reason', 'status', 'admin_note'];

    protected function casts(): array
    {
        return ['original_date' => 'date', 'requested_date' => 'date'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
