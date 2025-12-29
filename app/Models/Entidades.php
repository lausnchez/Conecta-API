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

    protected function casts(): array
    {
        return [
            'es_accesible' => 'boolean',
        ];
    }

    // RELACIONES
    //-------------------------------------------------------
    public function eventos(){
        return $this->hasMany(Eventos::class);
    }
}
