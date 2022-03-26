<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'sometimes|date_format:d/m/Y',
            'customer_id' => 'sometimes|integer|exists:customers,id',
            'car_number' => 'sometimes|string|max:255',
            'duration' => 'sometimes|integer|between:1,30',
            'notes' => 'sometimes|nullable|string',
            'services' => 'sometimes|array|min:1',
            'services.*' => 'integer|exists:services,id'
        ];
    }

    public function messages()
    {
        return [
            'customer_id.integer' => 'The customer_id must be an integer.',
            'customer_id.exists' => 'The selected customer_id is invalid.',
            'car_number.string' => 'The car_number field must be string.',
            'car_number.max' => 'The car_number may not be greater than 255 characters.'
        ];
    }
}
