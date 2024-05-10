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

            $crops = DB::table('createplantings')
            ->where('id', '72')
            ->select(
                '*'
            )
            ->first();

            $taskTypes = TaskType::all();
            $currentDate = Carbon::parse($crops->start);
            $harvestDate = Carbon::parse($crops->end);
            $daysDifference = $currentDate->diffInDays($harvestDate);
            $tasksRemaining = count($taskTypes);
            $randomFarmer = $farmers->isEmpty() ? null : $farmers->first();
            $dayNumber = 1;
            while ($currentDate->lte(Carbon::parse($harvestDate))) {
                foreach ($taskTypes as $taskType) {
                    if ($tasksRemaining > 0) {
                        Task::create([
                            'crops_planted_id' => $crops->id,
                            'task_type_id' => $taskType->id,
                            'due_date' => $currentDate,
                            'day_number' => $dayNumber, 
                            'assigned' => $randomFarmer->farmerID,
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
        return response()->json(['success' => true, 'message' => $daysDifference], 200);
    }

    public function view($id)
    {
        
        // Fetch task details based on the provided ID
        $tasks = Task::select('*')
        ->where('crops_planted_id', $id)
        ->get();
        
        // Pass the task details and tasks to the view
        return view('pages.tasks.viewtask', compact('tasks'));
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