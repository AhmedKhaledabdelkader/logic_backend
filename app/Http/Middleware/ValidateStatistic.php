<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateStatistic
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $rules = [

            'statistics' => [
                'required',
                'array',
            ],

            'statistics.*.id' => [
                'nullable',
                'integer',
                'exists:statistics,id',
            ],

            'statistics.*.number' => [
                'required',
                'string',
                'max:100',
            ],

            'statistics.*.title' => [
                'required',
                'string',
                'max:250',
            ],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules
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