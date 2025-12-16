<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $table = 'evento';
    protected $primaryKey = 'id_evento';
    
    // Campos rellenables
    protected $fillable = [
        'id_categoria',
        'fecha_evento',
        'tipo_evento',
        'bool_acceso',
        'bool_equipo',
        'bool_masc',
        'descripcion',
        'num_participantes',
        'incidencias',
        'valoracion'
    ];

    /**
     * Obtiene todos los eventos
     */
    public static function getAllEventos(){
        return self::all();
    }

    /**
     * Buscar evento por su Id
     */
    public static function getEventoById($id){
        return self::find($id);
    }
}
