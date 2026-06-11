<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Reemplazamos 'name' por tus campos reales de la base de datos
            'primer_nombre'     => ['required', 'string', 'max:100'],
            'segundo_nombre'    => ['nullable', 'string', 'max:100'],
            'primer_apellido'   => ['required', 'string', 'max:100'],
            'segundo_apellido'  => ['nullable', 'string', 'max:100'],
            'numero_tel'        => ['nullable', 'string', 'max:20'],
            
            // Si también envías la dirección del cliente en este formulario:
            'direccion_cliente' => ['nullable', 'string', 'max:255'], 

            // Arreglamos la validación del Email
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:150', // Ajustado al varchar(150) de tu tabla
                
                // Buscamos en la tabla 'personas' (o el nombre de tu tabla) 
                // e ignoramos usando tu clave primaria 'id_persona'
                Rule::unique('personas', 'email')->ignore($this->user()->id_persona, 'id_persona'),
            ],
        ];
    }
}