<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderapiRequest extends FormRequest
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

            'is_insured'=>['required'],
            'status'=>['required',Rule::in([1,4])],
            'prescription.*'=>['required','mimes:jpg,png' ],
            'delivering_address_id'=>['required', Rule::in(auth()->user()->addresses->pluck("id")->toArray())] ,

        ];
    }
}
