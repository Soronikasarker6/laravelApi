<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Flat3\Lodata\Controller\Response;
use PharException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the number of items per page, default is 5
        $perPage = $request->input('per_page', 5); 

        $data = Task::paginate($perPage);

        return response()->json($data);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            if (
                !isset($request->task_name) || !isset($request->email)
            ) {
                return response()->json(['error' => 'Send all required parameters'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $time = $request->input('time');
            $task_name = $request->input('task_name');
            $email = $request->input('email');



            // Create a new Data model instance and store the data
            $newtask = new Task();

            $newtask->time = $time;
            $newtask->task_name = $task_name;
            $newtask->email = $email;


            $newtask->save();
            return response()->json(['success' => 'Data insert successfully', 'data' => $newtask], Response::HTTP_OK);
        } catch (PharException $e) {
            abort(Response::HTTP_ACCEPTED, 'An error occurred.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        $taskUpdate = Task::findOrFail($id);
        $taskUpdate->time = $request->input('time');
        $taskUpdate->task_name = $request->input('task_name');
        $taskUpdate->email = $request->input('email');



        $result = $taskUpdate->update();
        
        if ($result) {
            return response()->json(['message' => 'Post created successfully', 'data' => $result], Response::HTTP_OK);
        } else {
            return ["Not updated data"];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {   $task->delete();
        return response()->json(['message' => 'Deleted successfully', 'data' => $task], Response::HTTP_NO_CONTENT);
    }
}

