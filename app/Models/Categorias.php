<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = "categorias";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // protected $hidden = ['created_at','updated_at'];

    // RELACIONES
    //-------------------------------------------------------
    public function eventos(){
        return $this->hasMany(Eventos::class);
    }

    // MÉTODOS PROPIOS
    //-------------------------------------------------------
    
}
