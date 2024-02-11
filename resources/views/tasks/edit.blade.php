<!-- resources/views/users/edit.blade.php -->

<x-app-layout>
    <div class="py-12 bg-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 form-container">
                <h2 class="text-2xl font-semibold mb-4">Edit Task</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title">task title</label>
                        <input type="text" name="title" id="title" class="input-field" value="{{ $task->title }}">
                    </div>
                    <div class="mb-4">
                        <label for="description">Task Description</label>
                        <textarea name="description" id="description" class="input-field">{{ $task->description }}</textarea>
                    </div>



                    <button type="submit" id="submit-button">Update Task</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
