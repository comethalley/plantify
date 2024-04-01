<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkFarm extends Model
{
    use HasFactory;
    protected $table = 'remarkfarms';
    protected $fillable = [
        'farm_id',
        'remarks',
        'remark_status',
        'validated_by',
        'visit_date',
        
    ];
}
