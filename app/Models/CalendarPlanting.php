<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarPlanting extends Model
{
    use HasFactory;

    protected $table = 'createplantings'; // Specify the correct table name

    protected $fillable = [
        'title',
        'start',
        'end',
        'status',
        'description',
    ];
}
