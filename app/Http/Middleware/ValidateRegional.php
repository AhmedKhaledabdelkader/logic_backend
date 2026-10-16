<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ValidateRegional
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $rules = [

            'regionals' => [
                'required',
                'array',
            ],

            'regionals.*.id' => [
                'nullable',
                'integer',
                'exists:regionals,id',
            ],

            'regionals.*.title' => [
                'nullable',
                'string',
                'max:250',
            ],

            'regionals.*.paragraph' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'regionals.*.image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,webp,jpg',
                'max:2048',
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