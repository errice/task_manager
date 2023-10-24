<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return redirect()->route('tasks.index');
});

//get all task list
Route::get('/tasks', function () {
    return view('index', [
        //diplay all task from the model 
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

//form input view
Route::view('/tasks/create', 'create')->name('tasks.create');


//Edit task 
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' =>  $task
    ]);
})->name('tasks.edit');


//get specific tastks 
Route::get('/tasks/{task}', function (Task $task) {
    //use the app varable
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');



//post form 
Route::post('/tasks', function (TaskRequest $request) {
    //validating via model
    $task = Task::create($request ->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully');
})->name('tasks.store');


//edit form 
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) { 
    //validating via model
    $task -> update($request ->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task updated Successfully');
})->name('tasks.update');


//delete data
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');