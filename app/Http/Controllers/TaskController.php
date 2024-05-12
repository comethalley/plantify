<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;


use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskType;
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
        $id = Auth::user()->id;

        $user = User::select('users.*', 'farms.id AS farm_id')
            ->leftJoin('farms', 'farms.farm_leader', '=', 'users.id')
            ->where('users.id', $id)
            ->first();
        

        if ($user && in_array($user->role_id, ['1', '2', '3'])) {
            // For roles 1, 2, and 3, retrieve tasks associated with the farm
            $tasks = CalendarPlanting::where('farm_id', $user->farm_id)
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($user && $user->role_id === '4') {
            // For role 4 (farmer), retrieve tasks assigned to the specific farmer
            $tasks = Task::where('assigned', $user->id)
                ->orderBy('id', 'ASC')
                ->get();
        } else {
            // Handle other roles or unauthorized users
            $tasks = []; // No tasks for unauthorized users
        }
        
        return view('pages.tasks.monitoring', compact('tasks'));
    }
    
    
    public function addTask(Request $request)
    {
        $userId = Auth::id();
        
        // Fetch farmers assigned to the farm leader
        $farmers = DB::table('users')
            ->join('farmers', 'farmers.farmer_id', '=', 'users.id')
            ->where('users.status', 1)
            ->where('farmers.farmleader_id', $userId)
            ->select(
                "farmers.farmer_id as farmerID",
                'users.firstname',
                "users.lastname",
                "users.email"
            )
            ->get();
    
        // Fetch crop information from createplantings table
        $crop = DB::table('createplantings')
            ->where('id', $request->crop_id)
            ->first();
    
        // Fetch task types
        $taskTypes = TaskType::all();
    
        // Calculate the number of days between start and end dates
        $currentDate = Carbon::parse($crop->start);
        $harvestDate = Carbon::parse($crop->end);
        $daysDifference = $currentDate->diffInDays($harvestDate);
    
        // Initialize variables
        $tasksRemaining = count($taskTypes);
        $randomFarmer = $farmers->isEmpty() ? null : $farmers->random(); // Randomly select a farmer
        $dayNumber = 1;
    
        // Loop through each day between start and end dates
        while ($currentDate->lte($harvestDate)) {
            foreach ($taskTypes as $taskType) {
                if ($tasksRemaining > 0) {
                    // Create tasks
                    Task::create([
                        'crops_planted_id' => $crop->id,
                        'task_type_id' => $taskType->id,
                        'due_date' => $currentDate,
                        'day_number' => $dayNumber, 
                        'assigned' => $randomFarmer->farmerID, // Assign a random farmer
                        'start' => $taskType->start,
                        'end' => $taskType->end,
                    ]);
                    $tasksRemaining--; // Decrease remaining tasks count for this type
                } else {
                    // If all task types are consumed, move to the next day
                    $dayNumber++;
                    $tasksRemaining = count($taskTypes); // Reset remaining tasks count
                    break; // Exit the loop to move to the next day
                }
            }
            $currentDate->addDay(); // Move to the next day
        }
    
        // Return success response
        return response()->json(['success' => true, 'message' => 'Tasks added successfully'], 200);
    }
    

    public function view($id)
    {
        // Fetch crop details based on the provided ID
        $crop = CalendarPlanting::findOrFail($id);
    
        // Calculate the number of days until harvest
        $startDate = Carbon::parse($crop->start);
        $endDate = Carbon::parse($crop->end);
        $daysUntilHarvest = $endDate->diffInDays($startDate);
    
        // Generate an array of days until harvest
        $days = [];
        for ($i = 1; $i <= $daysUntilHarvest; $i++) {
            $days[] = $i;
        }

        // Fetch tasks for the provided crop ID
        $tasks = Task::where('crops_planted_id', $id)->get();

        // Fetch predefined task types
        $predefinedTasks = TaskType::all();
    
        // Pass the crop details, days until harvest, and crop ID to the view
        return view('pages.tasks.viewtask', compact('crop', 'days', 'id', 'tasks', 'predefinedTasks'));
    }
    
    
    public function updateTaskStatus(Request $request, $id)
    {
        // Find the task by ID
        $task = Task::findOrFail($id);
        
        // Update the status
        $task->status = $request->status;
        $task->save();
        
        // Optionally, you can return a response
        return response()->json(['message' => 'Task status updated successfully'], 200);
    }

}