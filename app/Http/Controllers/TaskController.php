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
    $minimumTasks = 5; // Define the minimum number of tasks
    
    // Fetch users with their task counts

        $users = User::select('users.id', 'users.firstname', 'users.lastname', DB::raw('COUNT(CASE WHEN tasks.completed != 1 AND tasks.archived != 1  THEN tasks.id ELSE NULL END) AS tasks_count'))
        ->leftJoin('tasks', 'users.id', '=', 'tasks.user_id')
        ->groupBy('users.id', 'users.firstname', 'users.lastname')
        ->havingRaw('tasks_count < ?', [$minimumTasks]) // Filter users whose non-archived and non-completed task count is not equal to 1
        ->orderByRaw('tasks_count ASC')
        ->get();
    
        $overdueTasks = Task::where('due_date', '<', Carbon::now())->get();
    
    // Fetch tasks for monitoring
    $tasks = Task::where('completed', false)
        ->where('archived', false)
        ->orderByDesc('priority')
        ->orderBy('due_date')
        ->get();

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
    $minimumTasks = 5; // Adjust as needed
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
        // Find overdue tasks
        $overdueTasks = Task::where('due_date', '<', Carbon::now())->get();
    
        // Pass overdue tasks to the view
        return view('pages.tasks.missingtask', ['tasks' => $overdueTasks]);
    }
    

    // app/Http/Controllers/TaskController.php                                              

    public function tasksAssignedToMe()
    {
        $id = Auth::user()->id;
        $tasks = DB::table('tasks')
            ->where('user_id', $id)
            ->select("*")                           
            ->get();
        // In your controller method
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
