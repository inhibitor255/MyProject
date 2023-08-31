<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderList extends Model
{
    use HasFactory;

    // relationship with product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // relationship with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id', 'product_id', 'qty', 'total', 'order_code',
    ];
}
