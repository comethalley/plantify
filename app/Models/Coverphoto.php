<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverPhoto extends Model
{
    protected $fillable = ['user_id', 'user_photo'];
}
