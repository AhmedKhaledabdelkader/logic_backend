<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Validates create (POST) and update (PUT/PATCH) payloads for a service.
 * On update every top-level field is optional ("sometimes").
 */
class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        $req = $isUpdate ? 'sometimes' : 'required';

        return [
            'code' => ['nullable', 'string', 'max:5'],
            'slug' => ['nullable', 'string', 'max:150'],
            'title' => [$req, 'string', 'max:200'],
            'description' => [$req, 'string', 'max:5000'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],

            'items' => ['sometimes', 'array'],
            'items.*.id' => ['nullable', 'integer'],
            'items.*.title' => ['required', 'string', 'max:250'],
            'items.*.group_title' => ['nullable', 'string', 'max:200'],
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
