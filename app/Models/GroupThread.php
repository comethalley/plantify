<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'farm_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    
    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farm_id');
    }

    public function messages()
    {
        return $this->hasMany(GroupMessage::class, 'thread_id');
    }
}

