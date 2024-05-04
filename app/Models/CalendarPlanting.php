<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CalendarPlanting extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'createplantings'; // Specify the correct table name

    protected $fillable = [
        'title',
        'start',
        'end',
        'status',
        'farm_id',
        'harvested',
        'destroyed',
        'seed',
        'type'
    ];
}
