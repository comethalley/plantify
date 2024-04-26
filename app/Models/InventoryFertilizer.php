<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryFertilizer extends Model
{
    use HasFactory;
    protected $fillable = [
        "farm_id",
        "image",
        "fertilizer_name",
        "status"
    ];
}
