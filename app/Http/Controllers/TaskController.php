<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;


use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;  
use App\Models\User;
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
    // Retrieve users with their task counts
    $users = User::select('id', 'firstname', 'lastname')
    ->where('role_id', 4) // Filter by role_id == 4
    ->withCount([
        'tasks as tasks_count' => function ($query) {
            $query->where('completed', '!=', 1)
                  ->where('archived', '!=', 1)
                  ->where(function($query) {
                      $query->where('status', '!=', 'missing')
                            ->orWhereNull('status');
                  });
        }
    ])
    ->orderBy('tasks_count', 'asc')
    ->get();

    // Filter users who have exactly 5 tasks
    $usersWithFiveTasks = $users->filter(function ($user) {
        return $user->tasks_count == 6;
    });     
                                                                                                 
     
    
// Fetch tasks for monitoring
$role_id = auth()->user()->role_id;

if ($role_id == 4) {
    // Fetch tasks for role ID 4
    $tasksQuery = Task::with('user')->where('user_id', auth()->id());
} else {
    // Fetch all tasks
    $tasksQuery = Task::with('user');
}

$tasks = $tasksQuery->where('status', '!=', 'missing')
    ->where('archived', false)
    ->where('completed', false)
    ->orderByDesc('priority')
    ->orderBy('due_date', 'asc')
    ->get();

date_default_timezone_set('Asia/Manila');

foreach ($tasks as $task) {
    // Convert the task's due date to a Carbon instance in PH timezone
    $dueDate = Carbon::parse($task->due_date)->setTimezone('Asia/Manila');

    // Get the current date and time in PH timezone
    $currentDateTime = Carbon::now()->setTimezone('Asia/Manila');

    // Check if the due date is in the past
    if ($dueDate < $currentDateTime) {
        // Update the status of the task to 'missing'
        $task->update([
            "status" => "missing"
        ]); 

        // Notify the user about the missing task
        $task->user->notify(new MissingTaskNotification($task));
    }
}

// Return the view with the tasks and users data
return view('pages.tasks.monitoring', compact('tasks', 'users'));
}
        
                                

                                            
    public function store(Request $request)
    {
        // Fixed the syntax for the 'redirect' method
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|string|max:255',
            'due_date' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'nullable|string|max:11',
            'user_id' => 'nullable|exists:users,id',
        ]);                     

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
            'status' => $request->input('status'),
            'user_id' => $request->input('user_id'), // Fixed the input field name
        ]);

         $user_id = $request->user_id;

        $users = auth()->user();
            $userToNotify = User::find($user_id); // Replace $userId with the ID of the user you want to notify

            if ($userToNotify) {
                // Assuming you have created a new task and want to notify the user about it.
                $task = new Task(); // Assuming you have created a new task object here
            
                // Notify the user about the new task assignment
                $userToNotify->notify(new NewTaskAssignNotification($task));
            } else {
                // Handle the case where the user is not found
                // You can log an error, show a message, or take any other appropriate action.
            }
        // Fixed the syntax for the 'redirect' method
        return redirect()->route('tasks.monitoring')->with('success', 'Task Created Successfully');
    }

    public function edit(Task $task)
{
    $minimumTasks = 6; // Adjust as needed
    $usersMeetingMinimumTasks = User::withCount('tasks')->having('tasks_count', '>=', $minimumTasks)->get();
    
    $activeUsers = User::where('status', '1')->orderBy('id', 'DESC')->get();
    
    return view('pages.tasks.edit', compact('task', 'usersMeetingMinimumTasks', 'activeUsers'));
}

    public function update(Request $request, Task $task)
    {
        // Fixed the syntax for the 'update' method
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|string|max:255',
            'due_date' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
            'status' => $request->input('status'),
            'user_id' => $request->input('user_id'),
            // Fixed the input field name
        ]);

        // Fixed the syntax for the 'redirect' method
        return redirect()->route('tasks.monitoring')->with('success', 'Task Updated Successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.monitoring')->with('success', 'Task Deleted Successfully');
    }

    public function complete(Task $task)                                                        
    {
        $task->update([
            'completed' => true,
            'completed_at' => now(),
        ]);     
        $users = auth()->user();
        $users = User::all();
    
        foreach ($users as $user) {
            $tasks = new Task();
            $user->notify(new CompleteTaskNotification($tasks));
        }
        return redirect()->route('tasks.monitoring')->with('success', 'Task Completed Successfully');
    }

    public function showCompleted()
    {
        $role_id = auth()->user()->role_id;

// Initialize tasks query
if ($role_id == 4) {
    // Fetch tasks for role ID 4
    $tasksQuery = Task::with('user')->where('user_id', auth()->id());
} else {
    // Fetch all tasks
    $tasksQuery = Task::with('user');
}

// Fetch completed tasks
$completedTasks = $tasksQuery->where('completed', true)->orderBy('completed_at', 'desc')->get();

// Update status for completed tasks
foreach ($completedTasks as $task) {
    $task->update(['status' => 'completed']);
}

        
        return view('pages.tasks.taskshow', compact('completedTasks'));
    }
                                       
    // app/Http/Controllers/TaskController.php

    
    public function missingTasks()   
{
    // Find tasks that are either past their due date, not completed yet, or marked as missing
    $role_id = auth()->user()->role_id;

if ($role_id == 4) {
    // Fetch tasks for role ID 4
    $tasksQuery = Task::with('user')->where('user_id', auth()->id());
} else {
    // Fetch all tasks
    $tasksQuery = Task::with('user');
}

    $missingTasksQuery = Task::where(function($query) {
        $query->where('due_date', '<', Carbon::now())
          ->orWhere(function($subQuery) {
              $subQuery->whereNull('due_date')
                       ->where('completed', false);
          })
          ->orWhere('status', 'missing');
});

// Fetch missing tasks based on user role
if ($role_id == 4) {
    $missingTasksQuery->where('user_id', auth()->id());
}

$missingTasks = $missingTasksQuery->get();

// Merge missing tasks with other tasks based on the role
$tasks = $tasksQuery->where('status', '!=', 'missing')
    ->where('archived', false)
    ->where('completed', false)
    ->orderByDesc('priority')
    ->orderBy('due_date', 'asc')
    ->get();

// Merge missing tasks with other tasks
$tasks = $tasks->merge($missingTasks);

    // Update status of fetched tasks to 'missing'
    foreach ($missingTasks as $task) {
        $task->update(['status' => 'missing']);
    }
    
    // Pass missing tasks to the view
    return view('pages.tasks.missingtask', ['tasks' => $missingTasks]);
}

    // app/Http/Controllers/TaskController.php                                              

    public function tasksAssignedToMe()
{
    $tasks = Task::with('user')->where('user_id', auth()->id())->get();
    
    return view('pages.tasks.taskassign', ['tasks' => $tasks]);
}

        public function filterByStatus(Request $request)
    {
        $status = $request->input('status');
    
        if (strtolower($status) == 'all'){
            $tasks = Task::all();
        } else {
            $tasks = Task::Where('status', $status)->get();                                               
        }
        return response()->json(['tasks' => $tasks]);   
    }
                              
    public function archive(Task $task)
    {
        $task->update([
            'archived' => true,
            'archived_at' => now(),
        ]);
    
        return redirect()->route('tasks.monitoring')->with('success', 'Task Archived Successfully');
    }

    public function showArchived()
    {
        $archivedTasks = Task::where('archived', true)
                            ->orderBy('archived_at', 'desc')
                            ->get();
        return view('pages.tasks.archived', compact('archivedTasks'));
    }

    public function restore(Task $task)
{
    $task->update([
        'archived' => false,
        'archived_at' => null, // Optionally, you can reset the archived_at timestamp
    ]);

    return redirect()->route('archived')->with('success', 'Task Restored Successfully');
}

}                                         
