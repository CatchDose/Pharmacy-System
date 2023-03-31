<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
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
            'email'=> ["required","max:255","email"],
            'gender'=> ["required",Rule::in(["1","2"])],
            'password'=> ["required","confirmed","max:255","min:6"],
            'date_of_birth'=> ["required","date"],
            'avatar_image'=> ["required","mimes:jpg,png","max:4096"],
            'phone' => ["required", "digits:11"],
            'national_id'=> ["required","max:14","unique:users,national_id" ],
        ];
    }
}
