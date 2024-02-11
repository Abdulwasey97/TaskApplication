<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function show($taskId)
    {
        // Find the task by ID
        $task = Task::find($taskId);

        // Check if the task was found


        // Check if the task was found
        if ($task) {
            // Retrieve feedback for the task with user details
            $feedbacks = Feedback::where('task_id', $taskId)->with('user')->get();

            // Now you have the $task object and $feedbacks collection
            return view('tasks.feedback', ['task' => $task, 'feedbacks' => $feedbacks]);
        } else {
            // Handle the case where the task with the given ID was not found
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
    }

    public function store(Request $request, $taskId)
    {
        // Validate the form data
        $request->validate([
            'message' => 'required|string',
        ]);

        // Create a new feedback
        Feedback::create([
            'user_id' => auth()->user()->id,
            'task_id' => $taskId,

            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Feedback added successfully.');
    }
}
