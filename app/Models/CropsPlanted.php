<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropsPlanted extends Model
{
    use HasFactory;
    protected $fillable = [
        "farm_id",
        "crops",
        "area",
        "date_planted",
        "target_harvest",
        "harvested_date",
        "companion",
        "status"
    ];
}
