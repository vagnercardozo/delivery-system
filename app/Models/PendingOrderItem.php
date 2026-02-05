<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendingOrderItem extends Model
{
    protected $fillable = [
        'pending_order_id',
        'external_product_id',
        'external_product_name',
    ];

    public function pendingOrder(): BelongsTo
    {
        return $this->belongsTo(PendingOrder::class);
    }
}
