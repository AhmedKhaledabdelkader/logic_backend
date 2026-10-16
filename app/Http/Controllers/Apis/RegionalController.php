<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegionalResource;
use App\Services\RegionalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionalController extends Controller
{
    public function __construct(
        protected RegionalService $regionalService
    ) {
    }

    /**
     * Get Regional ID = 1.
     */
    public function index()
    {
        $regional = $this->regionalService->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Regional content retrieved successfully.',
            'data' => $regional
                ? new RegionalResource($regional)
                : null,
        ]);
    }

    /**
     * Create or update Regional ID = 1.
     */
    public function upsert(Request $request)
    {
        $data = $request->only([
            'title',
            'paragraph',
        ]);

        /*
         * Get uploaded image.
         */
        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image');
        }

        /*
         * Service always updates ID = 1.
         */
        $regional = $this->regionalService->upsert(
            $data
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Regional content saved successfully.',
            'data' => new RegionalResource($regional),
        ]);
    }

    /**
     * Delete Regional ID = 1.
     */
    public function destroy(): JsonResponse
    {
        $this->regionalService->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Regional content deleted successfully.',
        ]);
    }
}