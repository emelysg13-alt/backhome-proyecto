<?php

namespace App\Http\Requests;

//use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EntradaRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|min:5|max:50',
            'tag' => 'required|string|min:3|max:20',
            'contenido' => 'required|string|min:5|max:255',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.min' => 'El título debe tener al menos :min caracteres.',
            'titulo.max' => 'El título no debe exceder los :max caracteres.',

            'tag.required' => 'La etiqueta es obligatoria.',
            'tag.string' => 'La etiqueta debe ser una cadena de texto.',
            'tag.min' => 'La etiqueta debe tener al menos :min caracteres.',
            'tag.max' => 'La etiqueta no debe exceder los :max caracteres.',
            
            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.string' => 'El contenido debe ser una cadena de texto.',
            'contenido.min' => 'El contenido debe tener al menos :min caracteres.',
            'contenido.max' => 'El contenido no debe exceder los :max caracteres.',
        ];
    }
}
