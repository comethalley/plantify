<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index()
    {
        // Fixed the syntax for the 'with' method'
        // Example logic to select users with small task assignments
        $users = DB::table('users')
            ->leftJoin('tasks', 'users.id', '=', 'tasks.user_id')
            ->select('users.id', 'users.firstname', 'users.lastname', DB::raw('COUNT(tasks.id) as task_count'))
            ->groupBy('users.id', 'users.firstname', 'users.lastname')
            ->orderBy('task_count', 'ASC')
            ->get();

            $tasks = Task::where('completed', false)
            ->where('archived', false)
            ->orderBy('priority', 'desc')
            ->orderBy('due_date')
            ->get();
        return view('pages.tasks.monitoring', compact('tasks','users'));


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

        $user = DB::table('users')->where('status', '1')->orderBy('id', 'DESC')->get();
        return view('pages.tasks.edit', compact('task'), ['users' => $user]);
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
        $overdueTasks = Task::where('due_date', '<', now())->get();

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
