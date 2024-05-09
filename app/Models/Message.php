<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Message extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['thread_id', 'sender_id', 'text_content', 'image_path', 'create_date', 'isRead', 'status'];

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
