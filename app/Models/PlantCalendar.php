<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'crops',
        'planting_month',
        'planting_date',
        'harvest_date',
        'companion',
        'status',
    ];
}
