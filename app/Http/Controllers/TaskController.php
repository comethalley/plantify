<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;  
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index()
{
    // Retrieve users with their task counts
    $users = User::select('id', 'firstname', 'lastname')
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

    // Apply logic to allow editing only one task for users with exactly 5 tasks
    foreach ($usersWithFiveTasks as $user) {
        $editableTask = $user->tasks()->where('completed', '!=', 1)->where('archived', '!=', 1)->first();

        // If exactly one task is found, allow editing
        if ($editableTask) {
            $user->editable_task_id = $editableTask->id;
        } else {
            // If no editable task found, set editable_task_id to null
            $user->editable_task_id = null;
        }
    }         
  
                               

    
    $overdueTasks = Task::where('due_date', '<', Carbon::now())->get();
    
    // Fetch tasks for monitoring
    $tasks = Task::where('completed', false)
    ->where('archived', false)
    ->where('due_date', '>=', Carbon::now()->toDateTimeString()) 
    ->where('status', '!=', 'missing')
    ->orderByDesc('priority')
    ->orderBy('due_date')
    ->get();


// Iterate over tasks and update status if due date is today
foreach ($tasks as $task) {
    $currentDateTime = Carbon::now(); // Current date and time
    $dueDateTime = Carbon::parse($task->due_date); // Due date of the task

    if ($dueDateTime->isToday()) {
        $task->status = 'missing'; // Change the status to "missing" when due date is past
        $task->save();
    }

}
                                        

         
              

    return view('pages.tasks.monitoring', compact('tasks', 'users','overdueTasks'));
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
        return redirect()->route('tasks.monitoring')->with('success', 'Task Completed Successfully');
    }

    public function showCompleted()
    {
        
        $completedTasks = Task::where('completed', true)->orderBy('completed_at', 'desc')->get();

        return view('pages.tasks.taskshow', compact('completedTasks'));
    }
                                       
    // app/Http/Controllers/TaskController.php

    
    public function missingTasks()   
{
    // Find tasks that are either past their due date, not completed yet, or marked as missing
    $missingTasks = Task::where(function($query) {
                            $query->where('due_date', '<', Carbon::now())
                                  ->orWhere(function($query) {
                                      $query->whereNull('due_date')
                                            ->where('completed', false);
                                  })
                                  ->orWhere('status', 'missing'); // Include tasks with status 'missing'
                        })
                        ->get();
    
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
