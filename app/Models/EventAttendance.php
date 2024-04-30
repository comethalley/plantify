<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'age', 'email', 'contact', 'address', 'barangay'];
    // Add more fillable fields as needed

}
