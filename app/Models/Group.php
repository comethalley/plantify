<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_name',
    ];

    public function members()
    {
        return $this->hasMany(GroupMember::class, 'group_id');
    }

    public function threads()
    {
        return $this->hasMany(GroupThread::class, 'group_id');
    }

    public function farm()
{
    return $this->belongsTo(Farm::class);
}
}
