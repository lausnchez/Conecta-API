<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [];


    // RELACIONES
    //-------------------------------------------------------
    public function eventos(){
        return $this->belongsToMany(Eventos::class, 'eventos_tags', 'id_tag', 'id_evento');
    }

    // MÉTODOS PROPIOS
    //-------------------------------------------------------
    
}
