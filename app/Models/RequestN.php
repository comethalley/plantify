<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestN extends Model
{
    use HasFactory;

    protected $table = 'request_tbl';
    protected $fillable = [
        'id',
        'supply_tool',
        'supply_seedling',
        'supply_count',
        'letter_content',
        'requested_by',
        'status',
        'date_return',
    ];

}
