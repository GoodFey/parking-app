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


        return [
            'fio' => 'required|string|min:3|max:100',
            'gender' => 'required|boolean',
            'phone_number' => ['required', 'string',
                Rule::unique('clients', 'phone_number')->ignore($this->client),
                'regex:/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/'],
            'address' => 'nullable|string|max:255',
        ];


    }

    public function messages()
    {
        return [
            'fio.required' => 'Это поле должно быть заполнено',
            'gender.max' => 'Это поле должно быть заполнено',
            'phone_number.required' => 'Это поле должно быть заполнено',
            'address.required' => 'Это поле должно быть заполнено',

            'fio.min' => 'Это поле должно содержать минимум 3 символа',
            'phone_number.unique' => 'Этот номер уже внесен в базу',
            'phone_number.regex' => 'Заполните номер полностью',
        ];
    }
}
