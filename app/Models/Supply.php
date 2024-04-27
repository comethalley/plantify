<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $table = 'supply_type_tbl';
    protected $fillable = ['type', 'category'];
    
}
