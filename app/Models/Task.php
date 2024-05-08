<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// app/Models/Task.php

class Task extends Model
{
    use Notifiable;
    protected $fillable = ['title', 'description', 'priority', 'due_date','status', 'completed', 'completed_at', 'user_id','archived','archived_at','image'];
    protected $dates = ['due_date']; // Cast due_date attribute to a date
    
    public function user()                                                        
{              
    return $this->belongsTo(User::class, 'user_id');
}    
    

}
