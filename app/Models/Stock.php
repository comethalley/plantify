<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        "supplier_seeds_id",
        "available_seed",
        "used_seed",
        "total",
        "status"
    ];
}
