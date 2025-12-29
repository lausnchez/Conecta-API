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
    protected function casts(): array
    {
        return [
            'valoracion' => 'decimal:2',
        ];
    }

    // RELACIONES
    //-------------------------------------------------------
    public function entidad(){
        return $this->belongsTo(Entidades::class, 'id_entidad');
    }
    
    public function evento(){
        return $this->belongsTo(Eventos::class, 'id_evento');
    }
}
