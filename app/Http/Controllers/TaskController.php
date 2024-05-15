<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;


use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
    
    
    public function addTask()
    {
        // Fetch the crops planted from the database
        $cropsPlanted = CalendarPlanting::all();
    
        // Fetch the task types from the database
        $taskTypes = TaskType::all();
    
        // Get the logged-in farm leader
        $farmLeaderId = auth()->id();
    
        // Iterate over each crops planted
        foreach ($cropsPlanted as $crop) {
            // Check if tasks for this crop already exist
            $existingTasks = DB::table('tasks')
                ->where('crops_planted_id', $crop->id)
                ->count();
    
            // If tasks for this crop don't exist, add new tasks
            if ($existingTasks == 0) {
                // Calculate the number of days until harvest
                $startDate = Carbon::parse($crop->start);
                $endDate = Carbon::parse($crop->end);
                $daysUntilHarvest = $endDate->diffInDays($startDate);
    
                // Generate an array of unique random farmer IDs for each day
                $assignedFarmers = Farmer::where('farmleader_id', $farmLeaderId)->pluck('farmer_id')->toArray();
                $uniqueRandomFarmerIds = array_unique($assignedFarmers);
                $randomFarmerIds = [];
                foreach ($uniqueRandomFarmerIds as $farmerId) {
                    $randomFarmerIds = array_merge($randomFarmerIds, array_fill(0, floor($daysUntilHarvest / count($uniqueRandomFarmerIds)), $farmerId));
                }
                $remainingDays = $daysUntilHarvest % count($uniqueRandomFarmerIds);
                if ($remainingDays > 0) {
                    $randomFarmerIds = array_merge($randomFarmerIds, array_slice($uniqueRandomFarmerIds, 0, $remainingDays));
                }
                shuffle($randomFarmerIds);

                // Iterate over each day until harvest
                for ($day = 1; $day <= $daysUntilHarvest; $day++) {
                    // Get the random farmer ID for this day
                    $farmerId = $randomFarmerIds[$day - 1];
    
                    // Iterate over each task type
                    foreach ($taskTypes as $taskType) {
                        // Create a new task
                        Task::create([
                            'crops_planted_id' => $crop->id,
                            'task_type_id' => $taskType->id,
                            'day_number' => $day,
                            'assigned' => $farmerId,
                            'start' => $taskType->start,
                            'end' => $taskType->end,
                        ]);
                    }
                }
            }
        }
    
        return response()->json(['message' => 'Tasks added successfully.']);
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

        // Fetch all farmers of the logged-in farm leader
        $farmLeaderId = auth()->id();
        $farmers = User::whereHas('farmers', function ($query) use ($farmLeaderId) {
            $query->where('farmleader_id', $farmLeaderId);
        })->get();
    
        // Pass the crop details, days until harvest, and crop ID to the view
        return view('pages.tasks.viewtask', compact('crop', 'days', 'id', 'tasks', 'farmers'));
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
    
    public function updateTaskFarmer($id, $day, Request $request)
    {
        // Validate the request data
        $request->validate([
            'farmer_id' => 'required|exists:App\Models\User,id', // Validate if the farmer exists
        ]);

        // Find and update the tasks for the specified day
        Task::where('crops_planted_id', $id)
            ->where('day_number', $day)
            ->update(['assigned' => $request->farmer_id]);

        return response()->json(['message' => 'Task farmer updated successfully.']);
    }

    public function updateTaskTime(Request $request, $id)
{
    // Find the task by ID
    $task = Task::findOrFail($id);
    
    // Update the start and end times
    $task->start = $request->start;
    $task->end = $request->end;
    $task->save();
    
    // Optionally, you can return a response
    return response()->json(['message' => 'Task time updated successfully'], 200);
}

    

}