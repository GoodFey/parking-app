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
            'fio' => 'required|string|min:3',
            'gender' => 'required|string|max:7',
            'phone_number' => 'required|string|unique:clients,phone_number',
            'address' => 'nullable|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'color_of_carcass' => 'required|string',
            'gos_number' => 'required|integer|unique:cars,gos_number',
            'is_on_parking_now' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'fio.required' => 'Это поле должно быть заполнено',
            'gender.max' => 'Это поле должно быть заполнено',
            'phone_number.required' => 'Это поле должно быть заполнено',
            'address.required' => 'Это поле должно быть заполнено',
            'brand.required' => 'Это поле должно быть заполнено',
            'model.required' => 'Это поле должно быть заполнено',
            'color_of_carcass.required' => 'Это поле должно быть заполнено',
            'gos_number.required' => 'Это поле должно быть заполнено',

            'fio.min' => 'Это поле должно содержать минимум 3 символа',
            'phone_number.unique' => 'Такой номер уже зарегистрирован',
            'gos_number.unique' => 'Такой номер уже зарегистрирован',

        ];
    }
}
