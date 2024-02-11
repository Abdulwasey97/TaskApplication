<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Task List</h2>

                <a href="{{ route('tasks.create') }}" class="create-user-btn">
                    Create Tasks
                </a>

                <table class="table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $task->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $task->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $task->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @can('edit task')
                                        <!-- Dropdown for editing with all options -->
                                        <select name="status" class="select-field task-status" data-task-id="{{ $task->id }}">
                                            <option value="TO DO" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                                            <option value="IN PROGRESS" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="COMPLETED" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>


                                        </select>    <div color="red" class="message-container"></div>
                                    @else
                                        <!-- Display task status if the user doesn't have edit permissions -->
                                        {{ $task->status }}
                                    @endcan
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @can('give feedback')            <a href="{{ route('tasks.feedback', $task->id) }}" class="text-blue-500 mr-2">Feedbacks</a>@endcan
                             @can('edit task')             <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 mr-2">Edit</a>@endcan


                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                        @can('delete task')    <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>@endcan
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.task-status').change(function () {
            var taskId = $(this).data('task-id');
            var newStatus = $(this).val();
            var messageContainer = $(this).siblings('.message-container');

            // Send AJAX request to update task status
            $.ajax({
                type: 'POST',
                url: '{{ route('update.task.status') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    task_id: taskId,
                    status: newStatus
                },
                success: function (response) {
                    console.log(response);
                    messageContainer.html('<div class="text-green-500">Status updated successfully</div>');
                },
                error: function (error) {
                    console.error(error);
                    messageContainer.html('<div class="text-red-500">Failed to update status</div>');
                }
            });
        });
    });
</script>
