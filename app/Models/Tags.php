<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = ['created_at','updated_at'];


    // RELACIONES
    public function opinion(){

    }
}
