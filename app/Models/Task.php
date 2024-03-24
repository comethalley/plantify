<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Task.php

class Task extends Model
{
    protected $fillable = ['title', 'description', 'priority', 'due_date','status', 'completed', 'completed_at', 'user_id','archived','archived_at'];
    protected $dates = ['due_date']; // Cast due_date attribute to a date
  
    public function user()                                                        
{              
    return $this->belongsTo(User::class, 'user_id');
}    
    

}
