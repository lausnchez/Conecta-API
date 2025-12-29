<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidades extends Model
{
    protected $table = 'entidades';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'es_accesible',
        'foto_entidad'
    ];

    protected $hidden = ['created_at','updated_at'];


    // RELACIONES
    
}
