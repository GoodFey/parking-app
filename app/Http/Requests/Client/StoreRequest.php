<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fio' => 'required|string',
            'gender' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'nullable|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'color_of_carcass' => 'required|string',
            'gos_number' => 'required|integer',
        ];
    }
}
