<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\InsightResource;
use App\Services\InsightService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    public function __construct(
        protected InsightService $insightService
    ) {
    }

    /**
     * Get all insights.
     */
    public function index(): JsonResponse
    {
        $insights = $this->insightService->getAll();

        return response()->json([
            'status' => 'success',
            'message' => 'Insights retrieved successfully.',
            'data' => InsightResource::collection($insights),
        ]);
    }

    /**
     * Get featured insights.
     */
    public function featured(): JsonResponse
    {
        $insights = $this->insightService->getFeatured();

        return response()->json([
            'status' => 'success',
            'message' => 'Featured insights retrieved successfully.',
            'data' => InsightResource::collection($insights),
        ]);
    }

    /**
     * Get one insight.
     */
    public function show(int $id): JsonResponse
    {
        $insight = $this->insightService->find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Insight retrieved successfully.',
            'data' => new InsightResource($insight),
        ]);
    }

    /**
     * Create a new insight.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'], // 4MB
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $insight = $this->insightService->create([
            'title' => $validated['title'],
            // IMPORTANT: pull the uploaded file straight off the request,
            // not from $validated (validate() doesn't return UploadedFile objects the same way)
            'image' => $request->file('image'),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Insight created successfully.',
            'data' => new InsightResource($insight),
        ], 201);
    }

    /**
     * Update an existing insight.
     *
     * NOTE: This endpoint must be hit as a real multipart request, which means
     * the client CANNOT send a literal HTTP PUT verb — PHP does not populate
     * $_FILES (and therefore Laravel's $request->file()) for PUT/PATCH bodies.
     *
     * From Angular, POST the FormData to this URL and append:
     *   formData.append('_method', 'PUT');
     * and keep the route below defined as PUT (Laravel's method-spoofing
     * middleware rewrites it internally). If the frontend currently sends a
     * literal PUT with FormData, that alone is why new images never save.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        

        

        $validated = $request->all() ;

        

        $insight = $this->insightService->update($id, [
            'title' => $validated['title'],
            'image' => $request->file('image'),
            'is_featured' => $request->boolean('is_featured'),
            
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Insight updated successfully.',
            'data' => new InsightResource($insight),
        ]);
    }

    /**
     * Delete an insight.
     */
    public function destroy(int $id): JsonResponse
    {
        $this->insightService->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Insight deleted successfully.',
        ]);
    }
}