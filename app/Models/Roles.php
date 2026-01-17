<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Roles extends Model
{
    protected $table = "roles";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [];

    // RELACIONES
    //-------------------------------------------------------
    public function users(){
        return $this->hasMany(User::class, 'rol', 'id');
    }

    // MÉTODOS PROPIOS / SCOPES
    //-------------------------------------------------------
    /**
     * Recoge el rol buscando por el nombre
     * 
     * @param Builder $query
     * @param string $nombreRol Nombre del rol que queremos buscar
     * @return Builder
     */
    public function scopeNombre(Builder $query, string $nombreRol): Builder{
        return $query->where('nombre', 'LIKE','%'.$nombreRol.'%'); 
    }

}
