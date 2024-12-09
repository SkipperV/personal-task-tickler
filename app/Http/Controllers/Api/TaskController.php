<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(new TaskCollection(Task::whereBelongsTo($request->user()->spaces)->orderBy('rank')->paginate(20)));
    }

    public function show(Request $request, Task $task): JsonResponse
    {
        return response()->json(new TaskResource($task));
    }
}
