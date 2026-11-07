<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkStepRequest;
use App\Http\Resources\WorkStepResource;
use App\Services\WorkStepService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkStepController extends Controller
{
    public function __construct(
        protected WorkStepService $workStepService
    ) {
    }

    /**
     * List steps in order. Pass ?active=1 to hide inactive ones (public site).
     */
    public function index(Request $request): JsonResponse
    {
        $steps = $this->workStepService->getAll($request->boolean('active'));

        // Number the steps by their place in THIS list, so the public site
        // (?active=1) reads 01, 02, 03 even when a middle step is hidden.
        $steps->each(fn ($s, $i) => $s->setAttribute('display_number', $i + 1));

        return response()->json([
            'status' => 'success',
            'message' => 'Work steps retrieved successfully.',
            'data' => WorkStepResource::collection($steps),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $step = $this->workStepService->find($id);

        if (!$step) {
            return $this->notFound();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Work step retrieved successfully.',
            'data' => new WorkStepResource($step),
        ]);
    }

    public function store(WorkStepRequest $request): JsonResponse
    {
        $step = $this->workStepService->create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Work step created successfully.',
            'data' => new WorkStepResource($step),
        ], 201);
    }

    public function update(WorkStepRequest $request, int $id): JsonResponse
    {
        $step = $this->workStepService->find($id);

        if (!$step) {
            return $this->notFound();
        }

        $step = $this->workStepService->update($step, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Work step updated successfully.',
            'data' => new WorkStepResource($step),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $step = $this->workStepService->find($id);

        if (!$step) {
            return $this->notFound();
        }

        $this->workStepService->delete($step);

        return response()->json([
            'status' => 'success',
            'message' => 'Work step deleted successfully.',
        ]);
    }

    /**
     * Persist drag-and-drop ordering: { "ids": [3, 1, 2, ...] }
     * The list must contain every step exactly once.
     */
    public function reorder(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', 'exists:work_steps,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $this->workStepService->reorder($request->input('ids'));

        return response()->json([
            'status' => 'success',
            'message' => 'Work steps reordered successfully.',
            'data' => WorkStepResource::collection($this->workStepService->getAll()),
        ]);
    }

    private function notFound(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Work step not found.',
        ], 404);
    }
}
