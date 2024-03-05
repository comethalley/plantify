<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message_notif extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'message', // Add this line
        'is_read',
        
    ];
}
