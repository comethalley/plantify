<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        'image',
        'status',
    ];
   
}