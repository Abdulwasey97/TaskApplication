<!-- resources/views/users/create.blade.php -->

<x-app-layout>
    <div class="py-12 bg-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 form-container">       @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <h2 class="text-2xl font-semibold mb-4">Create Task</h2>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title">Title:</label>
                        <input type="text" name="title" class="input-field">
                    </div>

                    <div class="mb-4">
                        <label for="description">Description:</label>
                        <textarea name="description" class="input-field" required></textarea>
                    </div>



                    <div class="mb-4">
                        <label for="status">Status:</label>
                        <select name="status" id="role" class="form-control">
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <button type="submit" id="submit-button">Create Task</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
