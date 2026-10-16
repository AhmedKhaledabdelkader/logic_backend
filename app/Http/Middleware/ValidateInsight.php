<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateInsight
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => [
                    'required',
                    'string',
                    'max:200',
                ],

                'image' => [
                    'nullable',
                    'string',
                    'max:500',
                ],

                'is_featured' => [
                    'required',
                    'boolean',
                ],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        return $next($request);
    }
}