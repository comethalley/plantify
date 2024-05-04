<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Event;
class EventAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['event_id','name', 'age', 'email', 'contact', 'address', 'barangay', 'status'];
    // Add more fillable fields as needed


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
