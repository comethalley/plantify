<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\EventAttendance;
class Event extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'title',
        'start',
        'end',
        'starttime',
        'endtime',
        'visibility',
        'location',
        'description',
        'image',
    ];
   
    public function attendees()
    {
        return $this->hasMany(EventAttendance::class);
    }
}