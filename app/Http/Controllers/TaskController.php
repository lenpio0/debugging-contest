<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks_pending = Task::where('status', 'pending')->get();
        $tasks_completed = Task::where('status', 'completed')->get();
        $tasks_in_progress = Task::where('status', 'in_progress')->get();

        return view('tasks.index', compact('tasks_pending', 'tasks_completed', 'tasks_in_progress'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $saved = Task::create($validated);

        if ($saved) {
            session()->flash('flash.banner', 'Task saved successfully');
            session()->flash('flash.bannerStyle', 'success');
        } else {
            session()->flash('flash.banner', 'Task not saved');
            session()->flash('flash.bannerStyle', 'danger');
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $saved = $task->update($validated);

        if ($saved) {
            session()->flash('flash.banner', 'Task updated successfully');
            session()->flash('flash.bannerStyle', 'success');
        } else {
            session()->flash('flash.banner', 'Task not updated');
            session()->flash('flash.bannerStyle', 'danger');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}
