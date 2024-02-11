<!-- resources/views/users/edit.blade.php -->

<x-app-layout>
    <div class="py-12 bg-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 form-container">
                <h2 class="text-2xl font-semibold mb-4">Edit User</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name">User Name</label>
                        <input type="text" name="name" id="name" class="input-field" value="{{ $user->name }}">
                    </div>

                    <div class="mb-4">
                        <label for="email">User Email</label>
                        <input type="email" name="email" id="email" class="input-field" value="{{ $user->email }}">
                    </div>

                    <!-- You may need to adjust the password input based on your requirements for updating passwords -->

                    <div class="mb-4">
                        <label for="role">User Role</label>
                        <select name="role" id="role" class="select-field">
                            <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                            <option value="manager" {{ $user->hasRole('manager') ? 'selected' : '' }}>Manager</option>
                            <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <button type="submit" id="submit-button">Update User</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

