<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudesAmistadAceptadas extends Model
{
    protected $table = 'amistades';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario_sender',
        'id_usuario_receptor',
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $casts = [
        'id_usuario_sender' => 'integer',
        'id_usuario_receiver' => 'integer',
    ];

    // RELACIONES
    //-------------------------------------------------------

}
