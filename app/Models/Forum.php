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
}
