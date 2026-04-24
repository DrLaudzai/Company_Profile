<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('user.tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'status' => 'todo'
        ]);

        return back();
    }

    public function updateStatus(Request $request)
    {
        $task = Task::find($request->id);
        $task->status = $request->status;
        $task->save();

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $task = Task::find($request->id);
        $task->delete();

        return response()->json(['success' => true]);
    }

    public function edit(Request $request)
    {
        $task = Task::find($request->id);
        $task->title = $request->title;
        $task->save();

        return response()->json(['success' => true]);
    }
}
