<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportReason extends Model
{
    protected $table = 'report_reasons';

    protected $fillable = ['reason', 'other_reason'];
}
