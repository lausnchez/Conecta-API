<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logros extends Model
{
    protected $table = 'logros';
    public $timestamps = false;

    // Campos rellenables
    protected $fillable = [
        'nombre',
        'descripcion',
        'meta',
        'foto_logro',
    ];

    protected $hidden = [];

    protected function casts(): array
    {
        return [
            'meta' => 'integer',
        ];
    }

    // RELACIONES
    //-------------------------------------------------------
    
}
