<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    /**
     * Handle user registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = user::all();


        return view('users.index', compact('users'));
    }
    public function register(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Return a response
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate user input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();

            $token = $user->createToken('authToken')->accessToken;

            return response()->json(['message' => 'Login successful', 'user' => $user, 'access_token' => $token]);
        }

        // If login fails
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    /**
     * Handle user logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::user()->token()->revoke();

        return response()->json(['message' => 'Logout successful']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,manager,user',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole($request->input('role'));

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }
    public function create()
    {
        $users = User::all();

        return view('users.create', compact('users'));
    }
    public function edit(User $user)
    {
        // $user will automatically be populated with the user corresponding to the ID in the route

        return view('users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:admin,manager,user',
        ]);

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Sync the user's roles based on the selected role
        $user->syncRoles([$request->role]);


        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    public function destroy(User $user)
    {
        // Ensure the user exists
        if ($user) {
            // Delete the user
            $user->delete();

            // Optionally, you can add a success message or redirect to another page
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } else {
            // User not found, handle accordingly (e.g., redirect with an error message)
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
    }
}
