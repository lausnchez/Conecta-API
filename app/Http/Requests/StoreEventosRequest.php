<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventosRequest extends FormRequest
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
            'id_categoria' => 'required|exists:categorias,id',
            'id_entidad'   => 'required|exists:entidades,id',
            'id_creador'   => 'required|exists:users,id',

            'nombre' => 'required|string|max:255',
            'fecha_inicio_evento' => 'required|date_format:Y-m-d H:i:s',
            'fecha_final_evento'  => 'required|date_format:Y-m-d H:i:s|after_or_equal:fecha_inicio_evento',
            'descripcion' => 'nullable|string',
            'valoracion' => 'numeric|min:0|max:99.99',
            'ubicacion' => 'nullable|string|max:100',
            'num_participantes' => 'integer|min:0',
            'foto_evento' => 'nullable|string|max:255',
            'es_accesible' => 'boolean',
        ];
    }
}
