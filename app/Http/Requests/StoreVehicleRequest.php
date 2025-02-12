<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Customize this if you have authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'plate_number' => ['required', 'string', 'max:255', 'unique:vehicles,plate_number'],
            'chasis_number' => ['required', 'string', 'max:255', 'unique:vehicles,chasis_number'],
            'impound_reason' => ['required', 'string', 'max:255'],
            'impound_date' => ['required', 'date'],
            'image' => ['image', 'mimes:jpeg,png,jpg'],
            'owner_first_name' => ['required', 'string', 'max:255'],
            'owner_middle_name' => ['required', 'string', 'max:255'],
            'owner_last_name' => ['required', 'string', 'max:255'],
            'owner_nick_name' => ['required', 'string', 'max:255'],
            'owner_age' => ['required', 'integer', 'min:0'],
            'owner_sex' => ['required', 'string', Rule::in(['Male', 'Female', 'Other'])],
        ];
    }


    public function messages(): array
    {
        return [
            'plate_number.unique' => 'The plate number has already been taken.',
            'chasis_number.unique' => 'The chassis number has already been taken.',
            'owner_age.min' => 'The owner age must be at least 0.',
            'owner_sex.in' => 'The owner sex must be Male, Female, or Other.',
        ];
    }
}