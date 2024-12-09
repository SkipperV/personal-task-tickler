<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskStatusCollection;
use App\Models\Space;
use App\Models\TaskStatus;
use Illuminate\Http\JsonResponse;

// Currently in work
class TaskStatusController extends Controller
{
    public function index(Space $space): JsonResponse
    {
        return response()->json(new TaskStatusCollection($space->taskStatuses()->with('availableTransitionsTo')));
    }

    public function show(Space $space, TaskStatus $taskStatus): JsonResponse
    {
        return response()->json($taskStatus->getAvailableTransitionsTo());
    }

    public function availableTransitions(Space $space, TaskStatus $taskStatus): JsonResponse
    {
        return response()->json(new TaskStatusCollection($taskStatus->getAvailableTransitionsFrom($space)));
    }
}
