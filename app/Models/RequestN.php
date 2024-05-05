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
        'request_id',
        'supply_tool',
        'supply_tool1',
        'supply_tool2',
        'supply_seedling',
        'supply_seedling1',
        'supply_seedling2',
        'count_tool',
        'count_tool1',
        'count_tool2',
        'count_seedling',
        'count_seedling1',
        'count_seedling2',
        'letter_content',
        'requested_by',
        'status',
        'date_return',
    ];

}
