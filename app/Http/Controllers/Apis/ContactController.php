<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;

use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        $contact = $this->contactService->create(
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully.',
            'data' => $contact,
        ], 201);
    }
}