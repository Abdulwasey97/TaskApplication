<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        @if(auth()->check())
                            <strong>{{ __("User Role") }} :</strong>
                            @role('admin')
                                Administrator
                            @else
                                @role('manager')
                                    Manager
                                @else
                                    User
                                @endrole
                            @endrole

                            <table class="table table-bordered">
                                <tbody>
                                    <th>{{ __("Permissions") }} :</th>
                                    <td>
                                        @forelse(auth()->user()->getPermissionsViaRoles() as $permission)
                                            <span class="badge badge-success">{{ ucwords($permission->name) }},</span>
                                        @empty
                                            <span class="badge badge-warning">No permissions</span>
                                        @endforelse
                                    </td>
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(auth()->check())
                    @role('admin')


                        <div class="flex justify-center items-center">
                            <div class="flex-center image-spacing">
                                <div class="text-center">
                                    <!-- User Icon -->
                   <a href="users/index">                 <img src="{{ asset('9131529.png') }}" alt="User Icon" class="mx-auto" width="300" height="300">
                                    <p class="mt-2">User</p></a>
                                </div>
                            </div>

                            <div class="border-l-2 border-black-500 image-spacing"></div> <!-- Vertical line -->

                            <div class="flex-center image-spacing">
                                <div class="text-center">
                                    <!-- Task Icon -->
                                    <img src="{{ asset('8028200.png') }}" alt="Task Icon" class="mx-auto" width="300" height="300">
                                    <p class="mt-2">Tasks</p>
                                    <!-- Display tasks content here -->
                                    <!-- Replace this with your actual content related to tasks -->
                                </div>
                            </div>
                        </div>



                    @else
                        <!-- Show single column for user/manager -->
                        <div class="datatable-container">
                            <h2 class="text-3xl font-bold mb-4">Task</h2>
                            <table class="table" id="tasksTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>{{ $task->id }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>{{ $task->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endrole
                @endif
            </div>
        </div>
    </div>
    <style>
        .datatable-container {
            overflow-x: auto;
        }

        #tasksTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #tasksTable th,
        #tasksTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #tasksTable th {
            background-color: #f2f2f2;
        }

        #tasksTable tbody tr:hover {
            background-color: #f5f5f5;
        }

                            /* Center images and text */
                            .flex-center {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }

                            /* Space between images */
                            .image-spacing {
                                margin-right: 6rem;
                                margin-left: 2rem;
                            }
                        </style>


</x-app-layout>


