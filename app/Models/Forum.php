<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Forum extends Model
{
    use Notifiable;
    protected $fillable = [
        'user_id', 'question_id', 'question', 'language'
    ];
    public function likes()
    {
        return $this->belongsToMany(User::class, 'forum_likes')->withTimestamps();
    }
}
