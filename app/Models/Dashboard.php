<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'device_usage';
    protected $fillable = ['device_type', 'user_count'];
}
