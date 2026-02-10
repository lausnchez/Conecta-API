<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aplicaciones extends Model
{
    protected $table = 'aplicaciones';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Campos rellenables
    protected $fillable = [
        'nombre_app'
    ];

    protected $hidden = [];

    protected $casts = [
        'nombre_app' => 'string',
    ];

    // RELACIONES
    //-------------------------------------------------------
    public function eventos(){
        return $this->hasMany(Eventos::class, 'id_aplicacion', 'id');
    }
}
