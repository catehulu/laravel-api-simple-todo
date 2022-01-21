<?php

namespace App\Http\Controllers;

use App\Service\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $response = (new TaskService)->getAllTask();
        return response()->json(['code' => 200, 'message' => $response], 200);
    }

    public function viewUnfinished()
    {
        $response = (new TaskService)->getUnfinishedTask();
        return response()->json(['code' => 200, 'message' => $response], 200);
    }

    public function viewPriority()
    {
        $response = (new TaskService)->getPriorityTask();
        return response()->json(['code' => 200, 'message' => $response], 200);
    }

    public function viewGroup()
    {
        $response = (new TaskService)->getGroupTask();
        return response()->json(['code' => 200, 'message' => $response], 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'priority' => 'int',
            'date' => 'date',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400,  'message' => $validator->errors()], 400);
        }

        $taskRequest = $request->all();
        // panggil service untuk membuat task baru
        $response = (new TaskService())->updateTask($taskRequest);

        if ($response['error']) {
            return response()->json(['code' => 500, 'message' => 'Something is wrong with the server!'], 500);
        }

        return response()->json(['code' => 201, 'message' => 'Task is successfully updated'], 201);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detail' => 'required',
            'priority' => 'required|int',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400,  'message' => $validator->errors()], 400);
        }

        $taskRequest = $request->all();
        // panggil service untuk membuat task baru
        $response = (new TaskService())->createTask($taskRequest);

        if ($response['error']) {
            return response()->json(['code' => 500, 'message' => 'Something is wrong with the server!'], 500);
        }

        return response()->json(['code' => 201, 'message' => 'New task is successfully created'], 201);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400,  'message' => $validator->errors()], 400);
        }

        $taskRequest = $request->all();
        $response = (new TaskService())->deleteTask($taskRequest);

        if ($response['error']) {
            return response()->json(['code' => 500, 'message' => 'Something is wrong with the server!'], 500);
        }

        return response()->json(['code' => 201, 'message' => 'Task is successfully deleted'], 200);
    }
}
