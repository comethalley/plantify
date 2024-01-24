<?php

// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class TaskController extends Controller
{
    public function index()
    {
        // Fixed the syntax for the 'with' method
        $tasks = Task::where('completed', false)->orderBy('priority', 'desc')->orderBy('due_date')->get();
        return view('tasks.monitoring', compact('tasks'));
    }

    public function create()
    {

        $user = DB::table('users')->where('status', '1')->orderBy('id', 'DESC')->get();
        return view('tasks.create', ['users' => $user]);
    }

    
    public function store(Request $request)
    { 
        // Fixed the syntax for the 'redirect' method
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|max:255',
            'due_date' => 'nullable|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
            'user_id' => $request->input('user_id'),// Fixed the input field name
        ]);

        // Fixed the syntax for the 'redirect' method
        return redirect()->route('tasks.monitoring')->with('success', 'Task Created Successfully');
    }

    public function edit(Task $task)
    {
        
        $user = DB::table('users')->where('status', '1')->orderBy('id', 'DESC')->get();
        return view('tasks.edit',compact('task'), ['users' => $user]);
    }

    public function update(Request $request, Task $task)
    {
        // Fixed the syntax for the 'update' method
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|string|max:255',
            'due_date' => 'nullable|max:255',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
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
            'completed'=>true,
            'completed_at' =>now(),
        ]);
        return redirect()->route('tasks.monitoring')->with('success', 'Task Completed Successfully');
    }

    public function showCompleted()
    {
        $completedTasks = Task::where('completed',true)->orderBy('completed_at', 'desc')->get();
       
        return view('taskshow',compact('completedTasks'));
    }
    
}