<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends BaseModel
{
    use HasFactory;

    protected $fillable=[
        'user_one_id',
        'user_two_id',
        'status' 
    ];
}