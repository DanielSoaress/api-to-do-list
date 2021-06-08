<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Exception;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks =  Task::all();
            return response()->json(['message'=>'OK','data'=>$tasks],200);
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'data'=>""], 400);
        } 
    }

    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json(['message'=>'OK','data'=>$task],200);
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'data'=>""], 400);
        } 
    }

    public function store(Request $request)
    {
        try {
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => 1
            ]);
            $task->save();
            return response()->json(['message'=>'OK','data'=>$task],200);
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'data'=>""], 400);
        } 
    }


    public function update(Request $request, $id)
    {
        try {
            $task = Task::find($id);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->status = $request->status;
            $task->save();
            return response()->json(['message'=>'OK','data'=>$task],200);
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'data'=>""], 400);
        } 
    }

    public function destroy($id)
    {
        try {
            $task = Task::destroy($id);
            return response()->json(['message'=>'OK','data'=>$task],200);
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'data'=>""], 400);
        } 
    }
}
