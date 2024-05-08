<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;


use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\CalendarPlanting;
use App\Models\Farmer;
use App\Models\Farm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DateTime;
use App\Notifications\NewTaskAssignNotification;
use App\Notifications\CompleteTaskNotification;
use App\Notifications\MissingTaskNotification;

class TaskController extends Controller
{
    public function index()
    {
        // Fetch tasks along with associated data from related tables
        $tasks = DB::table('tasks')
            ->join('createplantings', 'tasks.crops', '=', 'createplantings.title')
            ->join('task_type', 'tasks.task_type_id', '=', 'task_type.id')
            ->join('farmers', 'tasks.user_id', '=', 'farmers.farmer_id')
            ->join('users', 'farmers.farmleader_id', '=', 'users.id')
            ->where('users.status', 1)
            ->select(
                'tasks.id as task_id',
                'createplantings.title as crops',
                'task_type.id as task_type_id',
                'farmers.farmer_id as user_id'
            )
            ->get();

        return view('pages.tasks.monitoring', compact('tasks'));
    }
    
    public function addTask(Request $request)
    {
        // Fetch data from createplantings table
        $plantings = CalendarPlanting::all();
        $planting = $plantings->first();

        // Get the ID of the currently authenticated user (assumed to be a farm leader)
        $userId = Auth::id();
        
        // Retrieve farmers associated with the farm leader
        $farmers = DB::table('users')
            ->join('farmers', 'farmers.farmer_id', '=', 'users.id')
            ->where('users.status', 1)
            ->where('farmers.farmleader_id', $userId)
            ->select(
                "farmers.farmer_id",
                'users.firstname',
                "users.lastname",
                "users.email"
            )
            ->get();

        // Check if there are any farmers associated with the farm leader
       $randomFarmer = $farmers->isEmpty() ? null : $farmers->first();

        
       // Create a new instance of Task model
       $task = new Task();
       
       // Set the 'crops' attribute to the value of $planting->title
       $task->crops = $planting->title;
       
   
       // Set a default value for the task_type_id field or provide a value as per your requirement
       $task->task_type_id = 1; // Example value, change as needed
       
       // Set the user_id to the randomly selected farmer's ID
       $task->user_id = $randomFarmer ? $randomFarmer->farmer_id : null;
       
       // Save the Task model to persist the changes to the database
       $task->save();

    
        return response()->json(['success' => true, 'message' => 'Task added successfully'], 200);

    }

    public function showCompleted()
    {
        // Fetch completed tasks along with associated data from related tables
        $completedTasks = DB::table('tasks')
            ->join('createplantings', 'tasks.crops', '=', 'createplantings.title')
            ->join('task_type', 'tasks.task_type_id', '=', 'task_type.id')
            ->join('farmers', 'tasks.user_id', '=', 'farmers.farmer_id')
            ->join('users', 'farmers.farmleader_id', '=', 'users.id')
            ->where('tasks.completed', 1) // Assuming there's a column named 'completed' indicating task completion
            ->where('users.status', 1)
            ->select(
                'tasks.id as task_id',
                'createplantings.title as crops',
                'task_type.id as task_type_id',
                'farmers.farmer_id as user_id'
                // Add more columns as needed
            )
            ->get();

        return view('pages.tasks.monitoring', compact('completedTasks'));
    }
}