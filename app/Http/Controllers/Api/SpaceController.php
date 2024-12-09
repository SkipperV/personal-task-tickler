<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpaceRequest;
use App\Http\Requests\UpdateSpaceRequest;
use App\Http\Resources\SpaceCollection;
use App\Http\Resources\SpaceResource;
use App\Http\Resources\TaskCollection;
use App\Models\Space;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class SpaceController extends Controller
{
    public function index(Request $request): SpaceCollection
    {
        return new SpaceCollection(Space::whereBelongsTo($request->user())->get());
    }

    public function show(Request $request, Space $space): JsonResource
    {
        return new SpaceResource($space);
    }

    public function tasks(Request $request, Space $space)
    {
        return response()->json(new TaskCollection($space->tasks()->withSubtasksCounts()->orderBy('rank')->paginate(20)));
    }

    public function store(StoreSpaceRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $space = auth()->user()->spaces()->create($fields);
        $space->settings()->create();
        // TODO: Create 3 basic Task statuses: To do, In progress, Done.
        // TODO: Create basic space_config db record.
        return response()->json($space, Response::HTTP_CREATED);
    }

    public function update(UpdateSpaceRequest $request, Space $space): JsonResponse
    {
        $fields = $request->validated();

        return response()->json($space->update($fields));
    }

    public function destroy(Space $space): JsonResponse
    {
        $space->delete();

        return response()->json(['message' => 'Successful operation']);
    }
}
