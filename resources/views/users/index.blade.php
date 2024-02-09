<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Users List</h2>

                <a href="{{ route('users.create') }}" class="create-user-btn">
                    Create User
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
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Roles
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->getRoleNames()->implode(', ') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 mr-2">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
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
<style>
    a.create-user-btn {
    display: inline-block;
    background-color: #3490dc;
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    margin: 0px;
    transition: background-color 0.3s ease;
}

/* Hover effect */
a.create-user-btn:hover {
    background-color: #01070c;
}
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

/* Style for the table header */
.table thead {
    background-color: #f8f9fa; /* Light gray background color */
}

/* Style for the table header cells */
.table th {
    padding: 1rem;
    text-align: left;
    font-size: 0.875rem; /* Adjust font size */
    font-weight: 600;
    text-transform: uppercase;
    color: #495057; /* Dark gray text color */
}

/* Style for the table body cells */
.table td {
    padding: 1rem;
    font-size: 0.875rem; /* Adjust font size */
    color: #495057; /* Dark gray text color */
    border-bottom: 1px solid #e2e8f0; /* Light gray border */
}

/* Style for alternating row colors in the table body */
.table tbody tr:nth-child(even) {
    background-color: #f1f5f8; /* Light blue background color */
}

</style>
