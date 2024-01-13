<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventcalendar extends Model
{
    use HasFactory;
    protected $fillable = [
        "category",
        "title",
        "event_date",
        "start_time",
        "end_time",
        "event_location",
        "description",
        "status"
    ];
}
