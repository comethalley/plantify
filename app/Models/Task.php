<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// app/Models/Task.php

class Task extends Model
{
    protected $fillable = ['crops_planted_id', 'task_type_id', 'farmer_id','day_number','assigned','start','end', 'status'];

    public function createPlanting()
    {
        return $this->belongsTo(CalendarPlanting::class, 'crops', 'title');
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }

    public static function taskQuery()
    {
        return self::with(['createPlanting', 'taskType', 'farmer'])
            ->join('farmers', 'tasks.farmer_id', '=', 'farmers.id')
            ->join('users', 'farmers.farmleader_id', '=', 'users.id')
            ->where('users.status', 1)
            ->select(
                'tasks.id as task_id',
                'tasks.crops',
                'tasks.task_type_id',
                'tasks.farmer_id as user_id'
            )
            ->get();
    }
}