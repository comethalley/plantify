<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
        'user_id', 'question_id', 'question', 'language'
    ];
    public function likes()
    {
        return $this->belongsToMany(User::class, 'forum_likes')->withTimestamps();
    }
}
