<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'area_id' => [Rule::requiredIf(Auth::user()->hasRole('admin')), "exists:areas,id", Rule::prohibitedIf(!Auth::user()->hasRole('admin'))],
            'priority' => [Rule::requiredIf(Auth::user()->hasRole('admin')), "digits_between:1,2", "min:1", Rule::prohibitedIf(!Auth::user()->hasRole('admin'))]
        ];
    }
}
