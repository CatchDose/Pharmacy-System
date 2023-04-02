<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'street_name' => ["required" , "max:255"],
            'building_number' => ["required" , "numeric" , "max:999" , "min:1"],
            'floor_number' => ["required" , "numeric" , "max:40" , "min:1"],
            'flat_number' => ["required" , "numeric" , "max:999" , "min:1"],
            'is_main' => ["required"],
            'area' => ["required"]
        ];
    }
}
