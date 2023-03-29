<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name'=> ["required","max:255"],
            'password'=> ["required","max:255","min:6"],
            'avatar_image'=> ["nullable","mimes:jpeg,png","max:4096"],
            'national_id'=> ["required","max:14","unique:users,national_id"],
            'email'=> ["required","max:255","unique:users,email"],
            'date_of_birth'=> ["required","date"],
            'gender'=> ["required",Rule::in(["1","2"])],
            'phone' => ["required", "digits:11"]
        ];
    }
}
