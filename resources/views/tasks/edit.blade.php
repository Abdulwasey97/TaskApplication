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

                    <button type="submit" class="submit-button">Update User</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
style>
    /* Add this to your CSS file or within a <style> tag in your Blade file */

/* Styling for the container */
.bg-container {
    background-color: #f7fafc;
}

/* Styling for the form */
.form-container {
    max-width: 500px;
    margin: 0 auto;
}

/* Styling for labels */
label {
    display: block;
    margin-bottom: 0.5rem;
    color: #4a5568;
}

/* Styling for input fields */
.input-field {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem;
    margin-bottom: 1rem;
}

/* Styling for select field */
.select-field {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem;
    margin-bottom: 1rem;
    background-color: #fff;
}

/* Styling for the submit button */
.submit-button {
    background-color: #4299e1;
    color: #ffffff;
    padding: 0.75rem 1.5rem;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-button:hover {
    background-color: #3182ce;
}

/* Additional styling for responsiveness */
@media (max-width: 767px) {
    .form-container {
        padding: 1rem;
    }
}

</style>
