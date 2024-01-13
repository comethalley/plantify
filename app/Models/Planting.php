<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'type',
        'location',
        'description',
        // Add other fillable fields as needed
    ];

    // Define relationships or additional model logic here if needed
}
