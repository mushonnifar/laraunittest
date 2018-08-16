<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller {

    //
    public function index() {
        $tasks = Task::all();
        $editableTask = null;

        if (request('id') && request('action') == 'edit') {
            $editableTask = Task::find(request('id'));
        }

        return view('tasks.index', compact('tasks', 'editableTask'));
    }

    public function store() {
        request()->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        Task::create(request()->only('name', 'description'));
        return back();
    }

    public function update(Task $task) {
        // dd(request()->all());
        $task->update(request()->only('name', 'description'));

        return redirect('/tasks');
    }

    public function destroy(Task $task) {
        $task->delete();

        return redirect('/tasks');
    }

}
