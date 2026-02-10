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

    public function participantes(){
        return $this->belongsToMany(User::class, 'eventos-users', 'id_evento', 'id_user');
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

    /**
     * Recoge eventos por el nombre
     * 
     * @param Builder $query
     * @param string $nombre Nombre de la app
     * @return Builder
     */
    public function scopeNombre(Builder $query, string $nombre): Builder{
        return $query->where('nombre', 'LIKE', '%'.$nombre.'%');

    }

    //por fecha
    // public function scopeFecha(Builder $query): Builder{}

    /**
     * Recoge eventos por app a la que se destinan
     * 
     * @param Builder $query
     * @param string $app Aplicación de destino
     * @return Builder
     */
    public function scopeApp(Builder $query, int $app): Builder{
        return $query->where('id_aplicacion', $app);
    }

    /**
     * Recoge eventos por entidad donde se organizan
     * 
     * @param Builder $query
     * @param string $entidad Entidad a buscar
     * @return Builder
     */
    public function scopeEntidad(Builder $query, int $entidad): Builder{
        return $query->where('id_entidad', $entidad);
    }

    /**
     * Recoge eventos en base a si son accesibles o no
     * 
     * @param Builder $query
     * @param string $accesibilidad Son accesibles o no
     * @return Builder
     */
    public function scopeAccessibilidad(Builder $query, bool $accessibilidad):Builder{
        return $query->where('es_accesible', $accessibilidad);
    }

    /**
     * Recoge un listado de eventos creados por un usuario en específico
     * 
     * @param Builder $query
     * @param string $user ID del usuario creador
     * @return Builder
     */
    public function scopeEventosCreador(Builder $query, int $user):Builder{
        return $query->where('id_creador', $user);
    }

}
