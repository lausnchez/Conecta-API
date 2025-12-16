<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $table = 'evento';
    protected $primaryKey = 'id_evento';

    //public $timestamps = false;

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

    protected $hidden = ['id_categoria','created_at','updated_at'];

    /**
     * Obtiene todos los eventos
     * Ruta: /v1/eventos
     * 
     * @return \App\Models\Eventos|null
     */
    public static function getAllEventos(){
        return self::all();
    }

    /**
     * Obtiene un evento por Id
     * Ruta: /v1/eventos/{id}
     * 
     * @param int $id
     * @return \App\Models\Eventos|null
     */
    public static function getEventoById($id){
        return self::find($id);
    }


    /**
     * Relación con Categorías
     */
    public function categoria(){
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }
}
