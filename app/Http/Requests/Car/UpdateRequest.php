<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'brand' => 'required',
            'model' => 'required',
            'color_of_carcass' => 'required',
            'gos_number' => ['required',
                Rule::unique('cars', 'gos_number')->ignore($this->car)],
            'is_on_parking_now' => 'nullable'
        ];


    }

    public function messages()
    {
        return [
            'brand.required' => 'Это поле должно быть заполнено',
            'model.required' => 'Это поле должно быть заполнено',
            'color_of_carcass.required' => 'Это поле должно быть заполнено',
            'gos_number.required' => 'Это поле должно быть заполнено',
            'gos_number.unique' => 'Такой номер уже зарегистрирован',

            'phone_number.unique' => 'Этот номер уже внесен в базу',
        ];
    }
}