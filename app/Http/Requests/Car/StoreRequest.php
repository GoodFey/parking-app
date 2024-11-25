<?php

namespace App\Http\Requests\Car;

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
            'brand' => 'required|string',
            'model' => 'required|string',
            'color_of_carcass' => 'required|string',
            'gos_number' => 'required|integer|unique:cars,gos_number',
            'is_on_parking_now' => 'nullable'
        ];
    }
    public function messages(): array
    {
        return [
            'brand.required' => 'Это поле должно быть заполнено',
            'model.required' => 'Это поле должно быть заполнено',
            'color_of_carcass.required' => 'Это поле должно быть заполнено',
            'gos_number.required' => 'Это поле должно быть заполнено',

            'gos_number.unique' => 'Такой номер уже зарегистрирован',
        ];
    }
}
