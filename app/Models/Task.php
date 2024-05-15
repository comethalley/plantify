<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// app/Models/Task.php

class Task extends Model
{
    protected $fillable = ['crops_planted_id', 'task_type_id', 'day_number', 'assigned', 'start', 'end', 'status'];

    public function createPlanting()
    {
        return $this->belongsTo(CalendarPlanting::class, 'crops_planted_id', 'id');
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'assigned', 'id');
    }

    public static function taskQuery()
    {
        return self::with(['createPlanting', 'taskType', 'farmer'])
            ->join('farmers', 'tasks.assigned', '=', 'farmers.farmer_id')
            ->join('users', 'farmers.farmleader_id', '=', 'users.id')
            ->where('users.status', 1)
            ->select(
                'tasks.id as task_id',
                'tasks.crops_planted_id as crops_planted_id',
                'tasks.task_type_id as task_type_id',
                'tasks.day_number as day_number',
                'tasks.assigned as user_id'
            )
            ->get();
    }
}
