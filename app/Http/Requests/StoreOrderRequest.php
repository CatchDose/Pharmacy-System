<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
        $size = $this->input("med") ? count($this->input("med")) : 0;


        return [
            'med' => ['required'],
            'qty' => ['required', 'size:' . $size],
        ];
    }

    public function messages(): array
    {
        return [
            'qty.size' => 'Please Provide A Quantity For Each Medicine ',
            'qty.required' => 'Please Check Your QTY Field is required',
            'med.required' => 'Please Check Your Medicine Field is required',
            'med.exists' => 'Please Create Medicine First',
        ];
    }
}
