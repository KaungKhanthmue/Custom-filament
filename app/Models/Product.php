<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends BaseModel
{
    protected $table="products";

    protected $fillable = [
        "name",
        "description",
        "category_id",
        "brand_id",
        "price",
    ];

    /** 
     * Relationship
     */

     public function category(): BelongsTo
     {
        return $this->belongsTo(Category::class);
     }

     public function brand(): BelongsTo
     {
        return $this->belongsTo(Brand::class);
     }

     public function orderItesm(): HasMany
     {
        return $this->hasMany(OrderItems::class);
     }
}
