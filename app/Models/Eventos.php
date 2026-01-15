<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Campos rellenables
    protected $fillable = [
        'id_categoria',
        'id_entidad',
        'id_creador',
        'nombre',
        'fecha_evento',
        'descripcion',
        'valoracion',
        'ubicacion',
        'num_participantes',
        'foto_evento',
        'es_accesible',
    ];

    protected $hidden = ['created_at','updated_at'];

    protected $casts = [
        'fecha_evento' => 'datetime',
        'valoracion' => 'decimal:2',
        'num_participantes' => 'integer',
        'es_accesible' => 'boolean',
    ];


    // RELACIONES
    //-------------------------------------------------------
    public function categoria(){
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }

    public function entidad(){
        return $this->belongsTo(Entidades::class, 'id_entidad');
    }

    public function creador(){
        return $this->belongsTo(User::class, 'id_creador');
    }

    public function tags(){
        return $this->belongsToMany(Tags::class, 'eventos_tags', 'id_evento', 'id_tag');
    }


    // MÉTODOS PROPIOS
    //-------------------------------------------------------

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

}
