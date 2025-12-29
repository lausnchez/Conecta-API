<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opiniones extends Model
{
    protected $table = 'opiniones';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Campos rellenables
    protected $fillable = [
        'id_entidad',
        'id_evento',
        'contenido',
        'valoracion',
    ];

    protected $hidden = ['created_at','updated_at'];

    // RELACIONES
    
}
