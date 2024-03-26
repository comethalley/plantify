<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UpcomingEventNotification;
class Event extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'title',
        'start', // Add this line
        'end',
        'location',
        'description',
        'status',
    ];
   
}