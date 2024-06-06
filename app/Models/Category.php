<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseModel
{
    protected $table="categories";

    protected $fillable=["name","description"];

    /**
     * Relationship
     */

     public function products(): HasMany
     {
        return $this->hasMany(Product::class);
     }
}
