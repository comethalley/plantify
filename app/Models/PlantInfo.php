<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'plant_name',
        'planting_date',
        'information',
        'companion',
        'status',
    ];
}
