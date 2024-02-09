<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', function () {
    $tasks = Task::all();
    return view('dashboard', ['tasks' => $tasks]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('users/index', [UserController::class, 'index'])->name('users.index');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('tasks/index', [TaskApiController::class, 'index'])->name('tasks.index');
Route::post('/tasks/store', [TaskApiController::class, 'store'])->name('tasks.store');
Route::get('/tasks/create', [TaskApiController::class, 'create'])->name('tasks.create');
Route::get('/tasks/{user}/edit', [TaskApiController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{user}', [TaskApiController::class, 'update'])->name('tasks.update');
Route::get('/tasks/destroy', [TaskApiController::class, 'destroy'])->name('tasks.destroy');
