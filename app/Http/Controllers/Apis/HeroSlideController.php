<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroSlideResource;
use App\Services\HeroSlideService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function __construct(
        protected HeroSlideService $heroSlideService
    ) {
    }

    /**
     * Get all hero slides.
     */
    public function index()
    {
        $heroSlides = $this->heroSlideService->getAll();

        return response()->json([
            'status' => 'success',
            'message' => 'Hero slides retrieved successfully.',
            'data' => HeroSlideResource::collection($heroSlides),
        ]);
    }

    /**
     * Get one hero slide.
     */
    public function show(int $id)
    {
        $heroSlide = $this->heroSlideService->getById($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Hero slide retrieved successfully.',
            'data' => new HeroSlideResource($heroSlide),
        ]);
    }

    /**
     * Create or update multiple hero slides.
     *
     * Expected FormData:
     *
     * slides[0][id]
     * slides[0][title]
     * slides[0][subtitle]
     * slides[0][image]
     *
     * slides[1][id]
     * slides[1][title]
     * slides[1][subtitle]
     * slides[1][image]
     */
    public function upsert(Request $request)
    {
        /*
         * Get normal form fields.
         *
         * Example:
         *
         * [
         *     [
         *         'id' => 3,
         *         'title' => 'movie3',
         *         'subtitle' => 'pirates of carbian',
         *     ]
         * ]
         */
        $slides = $request->input('slides', []);

        /*
         * Get uploaded files separately.
         */
        $files = $request->file('slides', []);

        /*
         * Attach each uploaded image
         * to its corresponding slide.
         */
        foreach ($slides as $index => &$slide) {

            $image = data_get(
                $files,
                "{$index}.image"
            );

            if ($image) {
                $slide['image'] = $image;
            }
        }

        /*
         * Important:
         * Remove the reference created by &$slide.
         */
        unset($slide);

        /*
         * Save all slides.
         */
        $heroSlides = $this->heroSlideService->upsertMany(
            $slides
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Hero slides saved successfully.',
            'data' => HeroSlideResource::collection(
                $heroSlides
            ),
        ]);
    }

    /**
     * Delete a hero slide.
     */
    public function destroy(int $id): JsonResponse
    {
        $this->heroSlideService->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Hero slide deleted successfully.',
        ]);
    }
}

