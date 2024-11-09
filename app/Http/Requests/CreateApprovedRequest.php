<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateApprovedRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('approveds', 'email')
                    ->where('school_id', auth()->user()->school_id)
                    ->ignore($this->route('approved')), // Ignora l'ID corrente per aggiornamenti
            ],
            'school_id' => 'nullable'
        ];

    }
}