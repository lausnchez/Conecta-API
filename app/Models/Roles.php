<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = "roles";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [];

    // RELACIONES
    //-------------------------------------------------------
    public function users(){
        return $this->hasMany(User::class, 'rol', 'id');
    }

    // MÉTODOS PROPIOS
    //-------------------------------------------------------
    

}
