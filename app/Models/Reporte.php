<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';

    // Campos rellenables
    protected $fillable = [
        'id_entidad',
        'id_evento',
        'contenido',
    ];

    // Campos ocultos
    protected $hidden = [];

    // RELACIONES
    // Cada reporte corresponde a una entidad concreta
    public function entidad(){
        return $this->hasOne(Entidades::class, 'id_entidad');
    }

    // Cada reporte es para un único evento
    public function evento(){
        return $this->hasOne(Eventos::class, 'id_evento');
    }
}
