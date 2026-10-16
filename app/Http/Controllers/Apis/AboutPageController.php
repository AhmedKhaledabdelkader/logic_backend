<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutPageResource;
use App\Services\AboutPageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function __construct(
        protected AboutPageService $aboutPageService
    ) {
    }

    public function show(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'About page retrieved successfully.',
            'data' => new AboutPageResource($this->aboutPageService->find()),
        ]);
    }

    /**
     * Same PUT-with-multipart route as Insights: hit via a spoofed POST
     * (_method=PUT) since story_image is a real file upload.
     *
     * `values` and `presence` (both repeatable lists) travel as JSON-encoded
     * strings inside the multipart body — FormData can't nest arrays/objects
     * directly — so each is decoded back into an array before validation.
     */
    public function update(Request $request): JsonResponse
    {
        $request->merge([
            'values' => $this->decodeListField($request->input('values', [])),
            'presence' => $this->decodeListField($request->input('presence', [])),
        ]);

        $validated = $request->validate([
            'hero_title' => ['required', 'string', 'max:150'],
            'hero_subtitle' => ['required', 'string', 'max:255'],

            'story_title' => ['required', 'string', 'max:150'],
            'story_paragraph' => ['required', 'string'],
            'story_image' => ['nullable', 'image', 'max:4096'],

            'presence' => ['array'],
            'presence.*.title' => ['required', 'string', 'max:150'],
            'presence.*.subtitle' => ['required', 'string', 'max:255'],

            'values' => ['array'],
            'values.*.icon' => ['required', 'string', 'max:50'],
            'values.*.title' => ['required', 'string', 'max:100'],
            'values.*.subtitle' => ['required', 'string', 'max:255'],
        ]);

        $validated['story_image'] = $request->file('story_image');

        $page = $this->aboutPageService->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'About page updated successfully.',
            'data' => new AboutPageResource($page),
        ]);
    }

    /**
     * `values`/`presence` normally arrive as a JSON string (Angular's
     * JSON.stringify via the real dashboard form), but a bracket-notation
     * form field (values[0][icon]=..., e.g. from manual Postman testing)
     * gets parsed by PHP into an array directly — json_decode() would
     * throw on that, since it only accepts a string. Handle both.
     */
    private function decodeListField(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode((string) $value, true);

        return is_array($decoded) ? $decoded : [];
    }
}