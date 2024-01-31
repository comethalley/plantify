<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_name',
        'farm_name',
        'address',
        'area',
        'farm_leader',
        'status',
        'title_land',
        'picture_land',
        'picture_land1',
        'picture_land2',
    ];

    
}
