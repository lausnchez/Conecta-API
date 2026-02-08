<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        'id_aplicacion',
        'nombre',
        'fecha_inicio_evento',
        'fecha_final_evento',
        'descripcion',
        'valoracion',
        'ubicacion',
        'num_participantes',
        'foto_evento',
        'es_accesible',
    ];

    protected $hidden = ['created_at','updated_at'];

    protected $casts = [
        'fecha_inicio_evento' => 'datetime',
        'fecha_final_evento' => 'datetime',
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

    public function aplicacion(){
        return $this->belongsTo(Aplicaciones::class, 'id_aplicacion');
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

    /**
     * Recoge los eventos según la categoría
     * 
     * @param Builder $query
     * @param bool $categoria Integer ID de la categoría
     * @return Builder
     */
    public function scopeCategoria(Builder $query, int $categoria): Builder{
        return $query->where('id_categoria', $categoria);
    }

}
