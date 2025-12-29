<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = "categorias";
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre'
    ];

    protected $hidden = ['created_at','updated_at'];

    // Relaciones
    public function evento(){
        
    }
}
