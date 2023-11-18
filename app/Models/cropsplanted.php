<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cropsplanted extends Model
{
    use HasFactory;

    protected $fillable = [
        "farm_id",
        "crops",
        "area",
        "date_planted",
        "target_harvest",
        "harvest_date",
        "farm_status_id",
        "status",
    ];
}
