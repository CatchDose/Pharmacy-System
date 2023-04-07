<?php

namespace App\Http\Requests\Api;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderapiRequest extends FormRequest
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
            'is_insured'=>['required',Rule::in([0,1])],
            'prescription'=>['required', 'array'],
            'prescription.*'=>[ 'mimes:jpg,png' ],
            'delivering_address_id'=>['required', Rule::in(auth()->user()->addresses->pluck("id")->toArray())] ,
        ];
    }

    public function messages()
    {
        return [
            'prescription.required' => "prescription is required",

            'prescription.*' => "images must be jpg, png."
        ];
    }


}
