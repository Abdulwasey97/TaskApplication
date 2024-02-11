<!-- resources/views/tasks/show.blade.php -->

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <h2 class="text-2xl font-semibold mb-4">Task Title: {{ $task->title }}</h2>
                <p class="text-lg mb-4">Task Description: {{ $task->description }}</p>
                @if ($feedbacks->count() > 0)
                <h3 class="text-xl font-semibold mb-4">Previous Feedback</h3>
                @foreach ($feedbacks as $feedback)
                    <div class="bg-gray-100 p-4 mb-4 rounded-md">
                        <p class="text-gray-600"><span class="font-bold">User:</span> {{ $feedback->user->name }}</p>
                        <p class="text-gray-800"><span class="font-bold">Feedback:</span> {{ $feedback->message }}</p>
                        @if ($feedback->created_at)
                        <p class="text-gray-500"><span class="font-bold">Date:</span> {{ $feedback->created_at->format('M d, Y H:i A') }}</p>
                    @endif
                    </div>
                @endforeach
            @else
                <p>No feedback available.</p>
            @endif


                <!-- Add new feedback -->
                <h3 class="text-xl font-semibold mb-4 mt-8">Add Feedback</h3>
                <form action="{{ route('feedback.store', ['taskId' => $task->id]) }}" method="POST">

                    @csrf
                    <div class="relative mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Your Feedback</label>
                        <textarea name="message" id="message" class="input-field"></textarea>
                        <button type="submit" class="button">Add Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


