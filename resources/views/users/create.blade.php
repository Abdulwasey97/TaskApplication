<!-- resources/views/users/create.blade.php -->

<x-app-layout>
    <div class="py-12 bg-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 form-container">
                <h2 class="text-2xl font-semibold mb-4">Create User</h2>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name">User Name</label>
                        <input type="text" name="name" id="name" class="input-field">
                    </div>

                    <div class="mb-4">
                        <label for="email">User Email</label>
                        <input type="email" name="email" id="email" class="input-field">
                    </div>

                    <div class="mb-4">
                        <label for="password">User Password</label>
                        <input type="password" name="password" id="password" class="input-field">
                    </div>

                    <div class="mb-4">
                        <label for="role">User Role</label>
                        <select name="role" id="role" class="select-field">
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <button type="submit" id="submit-button">Create User</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

