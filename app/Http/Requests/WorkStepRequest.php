<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Validates create (POST) and update (PUT/PATCH) payloads for a work step.
 * On update every field is optional ("sometimes").
 */
class WorkStepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $req = ($this->isMethod('PUT') || $this->isMethod('PATCH'))
            ? 'sometimes'
            : 'required';

        return [
            'title' => [$req, 'string', 'max:150'],
            'description' => [$req, 'string', 'max:5000'],
            'outcome' => ['nullable', 'string', 'max:2000'],
            'icon' => ['nullable', 'string', 'max:100'],
            // 1-based position; clamped by the repository.
            'sort_order' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    // The app's global exception handler turns every Throwable into a 500,
    // so return the 422 ourselves (same shape as the other validators).
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
