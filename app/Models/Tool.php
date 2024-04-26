<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'farm_name',
        'farm_leader',
        'address',
        'borrow_tool',
        'status',
        'request_letter',

    ];

}
