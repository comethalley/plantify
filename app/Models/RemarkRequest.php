<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkRequest extends Model
{
    use HasFactory;
    protected $table = 'remarkrequests';
    protected $fillable = [
        'request_id',
        'remarks',
        'remark_status',
        'validated_by',
        'date_return',

    ];
}
