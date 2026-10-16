<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoContentResource;
use App\Services\VideoContentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoContentController extends Controller
{
    public function __construct(
        protected VideoContentService
            $videoContentService
    ) {
    }

    public function show(): JsonResponse
    {
        $video =
            $this->videoContentService->get();

        return response()->json([
            'status' => 'success',

            'message' =>
                'Video content retrieved successfully.',

            'data' =>
                $video
                    ? new VideoContentResource($video)
                    : null,
        ]);
    }

    public function upsert(
        Request $request
    ): JsonResponse {

        $video =
            $this->videoContentService->upsert([
                'title' =>
                    $request->input('title'),

                'subtitle' =>
                    $request->input('subtitle'),

                'youtube_url' =>
                    $request->input('youtubeUrl'),
            ]);

        return response()->json([
            'status' => 'success',

            'message' =>
                'Video content saved successfully.',

            'data' =>
                new VideoContentResource($video),
        ]);
    }
}