<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    // No agregar timestamps? 

    protected $table = "categoria";
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre'
    ];

    protected $hidden = ['created_at','updated_at'];
}
