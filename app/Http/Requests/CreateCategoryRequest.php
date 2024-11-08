<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CreateCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('categories', 'name')
                    ->where('school_id', auth()->user()->school_id)
                    ->ignore($this->route('category')), // esclude il record attuale dall'unicità
            ],
            'icon' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.unique' => 'Il nome inserito esiste già. Scegli un nome diverso.',
            'icon.required' => 'Il campo icona è obbligatorio.',
        ];
    }
}