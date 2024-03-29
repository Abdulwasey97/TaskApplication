<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Tasknotify;
use App\Notifications\TaskUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TaskApiController extends Controller
{
    public function index()
    {

        $tasks = Task::all();

        // For API request
        if (request()->is('api/*')) {
            return response()->json($tasks);
        }
    }

    public function show($id)
    {
        // Get a specific task by ID
        $task = Task::findOrFail($id);

        // For API request
        if (request()->is('api/*')) {
            return response()->json($task);
        }
    }

    public function store(Request $request)
    {
        // Validate and store a new task
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:To Do,In Progress,Completed',
        ]);

        $task = Task::create($request->all());

        // For API request
        if (request()->is('api/*')) {
            return response()->json($task, 201);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate and update an existing task
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',

        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        $notification = new TaskUpdated($task->id);
        Notification::send(User::all(), $notification);


        // For API request
        if (request()->is('api/*')) {
            return response()->json($task);
        }
    }

    public function destroy($id)
    {
        // Delete a task

        $task = Task::findOrFail($id);
        $task->delete();

        // For API request
        if (request()->is('api/*')) {
            return response()->json(null, 204);
        }
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
        // Validate the request if needed

        $taskId = $request->input('task_id');
        $newStatus = $request->input('status');

        // Find and update the task status
        $task = Task::find($taskId);
        $task->status = $newStatus;
        $task->save();

        return response()->json(['success' => true]);
    }
}
