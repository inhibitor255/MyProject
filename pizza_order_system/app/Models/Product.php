<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'price',
        'waiting_time',
        'view_count',
    ];

    // relation with category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
