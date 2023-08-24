<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    // Relationship with product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
    ];
}
