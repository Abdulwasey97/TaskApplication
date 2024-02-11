<?php

use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskApiController;
use App\Http\Controllers\TaskWebController;
use App\Http\Controllers\FeedbackController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', function () {
        $tasks = Task::all();
        return view('dashboard', ['tasks' => $tasks]);
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('tasks/index', [TaskWebController::class, 'index'])->name('tasks.index');
});

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::post('/tasks/store', [TaskWebController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/create', [TaskWebController::class, 'create'])->name('tasks.create');
    Route::delete('/tasks/{task}', [TaskWebController::class, 'destroy'])->name('tasks.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin|manager']], function () {
    Route::get('/tasks/{task}/edit', [TaskWebController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskWebController::class, 'update'])->name('tasks.update');
    Route::post('/update-task-status', [TaskWebController::class, 'updateStatus'])->name('update.task.status');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/tasks/{taskId}/feedback', [FeedbackController::class, 'show'])->name('tasks.feedback');


    // Store feedback
    Route::post('/tasks/{taskId}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});
