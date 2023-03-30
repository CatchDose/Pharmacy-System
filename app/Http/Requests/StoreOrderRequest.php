<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
        // dd('validation class');
        return [
            'qty[]'=>[ 'array' , 'min:1'],
            'med[]'=>[ 'array' , 'min:1'],
        ];
    }

    public function messages(): array
{
    return [
        'qty[].required' => 'Please Check Your QTY Field is required',
        'med[].required' => 'Please Check Your Medicine Field is required',
    ];
}
}
