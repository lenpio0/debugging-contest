<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function __construct() {
    //     $sort = session('selected_sorting');
    // }

    public function index($sort)
    {
        // Sorts the tasks depending on the sort variable set by the index buttons
        
        if ($sort == 'asc') {
            $tasks_pending = Task::where('status', 'pending')->oldest('end_date')->get();
            $tasks_completed = Task::where('status', 'completed')->oldest('end_date')->get();
            $tasks_in_progress = Task::where('status', 'in progress')->oldest('end_date')->get();
        }
        elseif ($sort == 'desc') {
            $tasks_pending = Task::where('status', 'pending')->latest('end_date')->get();
            $tasks_completed = Task::where('status', 'completed')->latest('end_date')->get();
            $tasks_in_progress = Task::where('status', 'in progress')->latest('end_date')->get();
        }

        // Saving the last sorting option selected in the session

        session(['selected_sorting' => $sort]);

        return view('tasks.index', compact('tasks_pending', 'tasks_completed', 'tasks_in_progress', 'sort'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
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
    public function update(Request $request, Task $task)
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
        $deleted = $task->delete();

        if ($deleted) {
            session()->flash('flash.banner', 'Task deleted successfully');
            session()->flash('flash.bannerStyle', 'success');
        } else {
            session()->flash('flash.banner', 'Task not deleted');
            session()->flash('flash.bannerStyle', 'danger');
        }

        return redirect()->back();
    }
}
