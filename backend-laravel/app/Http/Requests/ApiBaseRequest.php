<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiBaseRequest extends FormRequest
{
    /**
     * The model associated with the request.
     *
     * @var mixed
     */
    protected $model;

    /**
     * An array to hold validation errors.
     *
     * @var array<int, array<string, mixed>>
     */
    protected $errors = [];

    /**
     * An array to hold request data.
     *
     * @var array<string, mixed>
     */
    public $data = [];

    /**
     * Handle a failed validation attempt.
     *
     * This method is called when validation fails. It formats the validation errors
     * and throws an HttpResponseException with a JSON response containing the errors.
     *
     * @throws HttpResponseException
     */
    public function failedValidation(Validator $validator): void
    {
        // Collecting validation errors
        foreach ($validator->errors()->get('*') as $field => $fieldErrors) {
            foreach ($fieldErrors as $error) {
                // Push an associative array with field name and error message
                $this->errors[] = [
                    'field' => $field,
                    'message' => $error,
                ];
            }
        }

        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'description' => 'Unprocessable Entity',
                'errors' => $this->errors,
            ], 422)
        );
    }
}
