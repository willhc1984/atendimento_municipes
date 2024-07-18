<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtendimentoRequest extends FormRequest
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
            'vereador' => 'required',
            'status' => 'required',
            'dataHora' => 'required'
        ];
    }

    public function messages(): array{
        return [
            'vereador.required' => 'Escolha o vereador!',
            'status.required' => 'Defina o status do atendimento!',
            'dataHora.required' => 'Defina a data/hora!'
        ];
    }
}
