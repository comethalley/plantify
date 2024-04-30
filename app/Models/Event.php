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
        'starttime',
        'endtime',
        'location',
        'description',
        'image',
        'status',
    ];
    public function interests()
    {
        return $this->hasMany(Interest::class);
    }
    public function attendees()
{
    return $this->hasMany(EventAttendance::class);
}
}