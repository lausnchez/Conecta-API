<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventosRequest extends FormRequest
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
            'id_categoria' => 'sometimes|exists:categorias,id',
            'id_entidad'   => 'sometimes|exists:entidades,id',

            'nombre' => 'sometimes|string|max:255',
            'fecha_inicio_evento' => 'sometimes|date',
            'fecha_final_evento'  => 'sometimes|date|after_or_equal:fecha_inicio_evento',
            'descripcion' => 'sometimes|nullable|string',
            'valoracion' => 'sometimes|numeric|min:0|max:99.99',
            'ubicacion' => 'sometimes|nullable|string|max:100',
            'num_participantes' => 'sometimes|integer|min:0',
            'foto_evento' => 'sometimes|string|max:255',
            'es_accesible' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
        
        ];
    }
}
