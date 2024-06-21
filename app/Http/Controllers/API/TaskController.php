<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Services\TaskServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskServices $TaskServices)
    {
        $this->taskService = $TaskServices;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date|string',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $login = Auth::user();
        $task = $this->taskService->addTask($validator->validated(), $login);
        return response()->json(['message' => 'Task added successfully', 'task' => $task], Response::HTTP_CREATED);
    }

    public function returnData()
    {
        $login = Auth::user();
        $tasks = $this->taskService->getTasks($login->id);
        return response()->json(['tasks' => $tasks], Response::HTTP_OK);
    }
}
