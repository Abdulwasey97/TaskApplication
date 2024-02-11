<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\TaskUpdated;
use Illuminate\Support\Facades\Notification;

class TaskWebController extends Controller
{
    public function index()
    {

        $tasks = Task::all();



        // For Blade view
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {

        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:To Do,In Progress,Completed',
        ]);

        $task = Task::create($request->all());


        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',

        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        $notification = new TaskUpdated($task->id);
        Notification::send(User::all(), $notification);


        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {


        $task = Task::findOrFail($id);
        $task->delete();


        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
    public function create()
    {
        $tasks = Task::all();

        return view('tasks.create', compact('tasks'));
    }
    public function edit(Task $task)
    {


        return view('tasks.edit', compact('task'));
    }
    public function updateStatus(Request $request)
    {

        $taskId = $request->input('task_id');
        $newStatus = $request->input('status');

        $task = Task::find($taskId);
        $task->status = $newStatus;
        $task->save();

        return response()->json(['success' => true]);
    }
}
