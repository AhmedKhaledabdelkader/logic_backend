<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService
    ) {
    }

    /**
     * List services. Pass ?active=1 to hide inactive ones (public site).
     */
    public function index(Request $request): JsonResponse
    {
        $services = $this->serviceService->getAll($request->boolean('active'));

        return response()->json([
            'status' => 'success',
            'message' => 'Services retrieved successfully.',
            'data' => ServiceResource::collection($services),
        ]);
    }

    /**
     * Get one service by numeric id or slug.
     */
    public function show(string $service): JsonResponse
    {
        $model = $this->serviceService->find($service);

        if (!$model) {
            return $this->notFound();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Service retrieved successfully.',
            'data' => new ServiceResource($model),
        ]);
    }

    public function store(ServiceRequest $request): JsonResponse
    {
        $service = $this->serviceService->create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Service created successfully.',
            'data' => new ServiceResource($service),
        ], 201);
    }

    public function update(ServiceRequest $request, int $id): JsonResponse
    {
        $model = $this->serviceService->find($id);

        if (!$model) {
            return $this->notFound();
        }

        $service = $this->serviceService->update($model, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Service updated successfully.',
            'data' => new ServiceResource($service),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $model = $this->serviceService->find($id);

        if (!$model) {
            return $this->notFound();
        }

        $this->serviceService->delete($model);

        return response()->json([
            'status' => 'success',
            'message' => 'Service deleted successfully.',
        ]);
    }

    /**
     * Persist drag-and-drop ordering: { "ids": [3, 1, 2, ...] }
     */
    public function reorder(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:services,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $this->serviceService->reorder($request->input('ids'));

        return response()->json([
            'status' => 'success',
            'message' => 'Services reordered successfully.',
            'data' => ServiceResource::collection($this->serviceService->getAll()),
        ]);
    }

    private function notFound(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Service not found.',
        ], 404);
    }
}
