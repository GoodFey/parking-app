<?php

namespace App\Http\Requests\Client;

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

        if (request()->routeIs('clients.update')) {

            return [
                'fio' => 'required|min:3',
                'gender' => 'required|max:7',
                'phone_number' => ['required',
                    Rule::unique('clients', 'phone_number')->ignore($this->client)],
                'address' => 'nullable|string',
            ];
        } elseif (request()->routeIs('cars.update')) {
            return [
                'brand' => 'required',
                'model' => 'required',
                'color_of_carcass' => 'required',
                'gos_number' => ['required',
                    Rule::unique('cars', 'gos_number')->ignore($this->car)],
                'is_on_parking_now' => 'nullable'
            ];
        }
        return [];
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
            'gos_number.unique' => 'Такой номер уже зарегистрирован',

            'fio.min' => 'Это поле должно содержать минимум 3 символа',
            'phone_number.unique' => 'Этот номер уже внесен в базу',


        ];
    }
}
