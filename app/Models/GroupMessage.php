<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id', 'sender_id', 'content', 'image_path', 'status', 'create_date',
    ];

    public function thread()
    {
        return $this->belongsTo(GroupThread::class, 'thread_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id'); // Assuming you have a 'group_id' column
    }
}

