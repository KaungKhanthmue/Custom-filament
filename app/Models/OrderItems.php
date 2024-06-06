<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends BaseModel
{
  protected $table="order_items";
  protected $fillable = [
    "order_id",
    "product_id",
    "price",
  ];

  /**
   * Relationship
   */

   public function order(): BelongsTo
   {
    return $this->belongsTo(Order::class);  
   }
   public function product(): BelongsTo
   {
    return $this->belongsTo(Product::class);
   }
}
