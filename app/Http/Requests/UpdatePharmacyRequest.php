<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyRequest extends FormRequest
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

            'name' => ["required", "max:255"],
            'avatar_image' => ["nullable", "mimes:jpg,png", "size:4096"],
            'email' => ["required", "max:255", "unique:users,email," . $this->pharmacy->owner->id],
            'phone' => ["required", "digits:11"],
            'area_id' => ["required", "exists:areas,id"],
            'priority' => ["required", "digits_between:1,2", "min:1"]
        ];
    }
}
