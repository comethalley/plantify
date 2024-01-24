<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Task.php

class Task extends Model
{
    protected $fillable = ['title', 'description', 'priority', 'due_date', 'completed', 'completed_at','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
