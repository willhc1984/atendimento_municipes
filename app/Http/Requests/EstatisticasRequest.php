<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstatisticasRequest extends FormRequest
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
            'data_inicial' => [
                Rule::requiredIf($this->filled('data_final')),
                'before_or_equal:data_final'
            ],
            'data_final' => [
                Rule::requiredIf($this->filled('data_inicial')),
                'before_or_equal:today'
            ]
        ];
    }

    public function messages()
    {
        return [
            'data_inicial.required' => 'Selecione data inicial e final.',
            'data_final.required' => 'Selecione a data inicial e final.',
            'data_inicial.before_or_equal' => 'A data inicial não pode ser maior que a data final.',
            'data_final.before_or_equal' => 'A data final não pode ser uma data futura.',
        ];
    }
}
