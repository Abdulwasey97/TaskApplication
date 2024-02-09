<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function index()
    {
        // Get all tasks
        $tasks = Task::all();

        // For API request
        if (request()->is('api/*')) {
            return response()->json($tasks);
        }

        // For Blade view
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        // Get a specific task by ID
        $task = Task::findOrFail($id);

        // For API request
        if (request()->is('api/*')) {
            return response()->json($task);
        }

        // For Blade view
        return view('tasks.show', compact('task'));
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

        // For Blade view
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function update(Request $request, $id)
    {
        // Validate and update an existing task
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:To Do,In Progress,Completed',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        // For API request
        if (request()->is('api/*')) {
            return response()->json($task);
        }

        // For Blade view
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
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

        // For Blade view
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
